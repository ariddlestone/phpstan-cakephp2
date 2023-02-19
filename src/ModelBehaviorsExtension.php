<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use Exception;
use PHPStan\BetterReflection\Reflection\Adapter\ReflectionMethod;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ExtendedMethodReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\ObjectType;

/**
 * Adds methods to {@link Model}s from {@link ModelBehavior} classes.
 */
final class ModelBehaviorsExtension implements MethodsClassReflectionExtension
{
    /**
     * @var ReflectionProvider
     */
    private $reflectionProvider;

    /**
     * @var array<string>
     */
    private $behaviorPaths;

    /**
     * @var array<MethodReflection>|null
     */
    private $behaviorMethods = null;

    /**
     * @param array<string> $behaviorPaths
     */
    public function __construct(
        ReflectionProvider $reflectionProvider,
        array $behaviorPaths
    ) {
        $this->reflectionProvider = $reflectionProvider;
        $this->behaviorPaths = $behaviorPaths;
    }

    /**
     * @throws Exception
     */
    public function hasMethod(
        ClassReflection $classReflection,
        string $methodName
    ): bool {
        return $classReflection->is('Model')
            && in_array(
                $methodName,
                array_map(
                    [$this, 'getMethodReflectionName'],
                    $this->getBehaviorMethods()
                )
            );
    }

    public function getMethod(
        ClassReflection $classReflection,
        string $methodName
    ): MethodReflection {
        $methodReflections = array_filter(
            $this->getBehaviorMethods(),
            static function (
                MethodReflection $methodReflection
            ) use ($methodName) {
                return $methodReflection->getName() === $methodName;
            }
        );
        if (! $methodReflections) {
            throw new Exception('Method not found');
        }
        return reset($methodReflections);
    }

    /**
     * Gets all behavior methods from known behavior classes.
     *
     * @return array<MethodReflection>
     *
     * @throws Exception
     */
    private function getBehaviorMethods(): array
    {
        if ($this->behaviorMethods === null) {
            $classReflectionFinder = new ClassReflectionFinder(
                $this->reflectionProvider
            );
            $classReflections = $classReflectionFinder->getClassReflections(
                $this->behaviorPaths,
                'ModelBehavior'
            );
            $this->behaviorMethods = [];
            foreach ($classReflections as $classReflection) {
                $this->behaviorMethods = array_merge(
                    $this->behaviorMethods,
                    $this->getModelBehaviorMethods($classReflection)
                );
            }
        }
        return $this->behaviorMethods;
    }

    /**
     * Returns all methods for the class which have a first parameter of Model,
     * with that parameter removed.
     *
     * Also filters out private, protected, and static methods.
     *
     * @return array<MethodReflection>
     */
    private function getModelBehaviorMethods(
        ClassReflection $classReflection
    ): array {
        $methodNames = array_map(
            [$this, 'getMethodReflectionName'],
            $classReflection->getNativeReflection()->getMethods()
        );
        /** @var array<ExtendedMethodReflection> $methodReflections */
        $methodReflections = array_filter(
            array_map([$classReflection, 'getNativeMethod'], $methodNames),
            [$this, 'filterBehaviorMethods']
        );
        return array_map([$this, 'wrapBehaviorMethod'], $methodReflections);
    }

    /**
     * Returns true if the given method would be made available as a behavior
     * method.
     *
     * Specifically it must meet the following conditions:
     * * Be public
     * * Not be static
     * * Have at least one variant which accepts a Model as its first parameter
     */
    private function filterBehaviorMethods(
        ExtendedMethodReflection $methodReflection
    ): bool {
        return $methodReflection->isPublic()
            && ! $methodReflection->isStatic()
            && array_filter(
                $methodReflection->getVariants(),
                [$this, 'filterBehaviorMethodVariants']
            );
    }

    /**
     * Returns true if the given method variant accepts a Model as its first
     * parameter.
     */
    private function filterBehaviorMethodVariants(
        ParametersAcceptor $parametersAcceptor
    ): bool {
        $parameters = $parametersAcceptor->getParameters();
        /** @var ParameterReflection|null $firstParameter */
        $firstParameter = array_shift($parameters);

        if (! $firstParameter) {
            return false;
        }

        if (
            $firstParameter->getType()
                ->isSuperTypeOf(new ObjectType('Model'))
                ->no()
        ) {
            return false;
        }

        return true;
    }

    /**
     * Wraps a method reflection in a wrapper which removes the first parameter.
     */
    private function wrapBehaviorMethod(
        MethodReflection $methodReflection
    ): MethodReflection {
        return new ModelBehaviorMethodWrapper($methodReflection);
    }

    /**
     * Returns the name of a method from its reflection.
     *
     * @param MethodReflection|ReflectionMethod $methodReflection
     */
    private function getMethodReflectionName($methodReflection): string
    {
        return $methodReflection->getName();
    }
}
