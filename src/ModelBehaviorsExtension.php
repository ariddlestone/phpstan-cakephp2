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
     * @return array<MethodReflection>
     *
     * @throws Exception
     */
    private function getBehaviorMethods(): array
    {
        if ($this->behaviorMethods === null) {
            $classNames = $this->getClassNamesFromPaths($this->behaviorPaths);
            $classReflections = array_map(
                [$this->reflectionProvider, 'getClass'],
                $classNames
            );
            /** @var array<ClassReflection> $classReflections */
            $classReflections = array_filter(
                $classReflections,
                static function (ClassReflection $classReflection) {
                    return $classReflection->is('ModelBehavior');
                }
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
     * @param array<string> $paths
     *
     * @return array<string>
     *
     * @throws Exception
     */
    private function getClassNamesFromPaths(array $paths): array
    {
        $classPaths = [];
        foreach ($paths as $path) {
            $filePaths = glob($path);
            if (! is_array($filePaths)) {
                throw new Exception(sprintf('glob(%s) caused an error', $path));
            }
            $classPaths = array_merge($classPaths, $filePaths);
        }
        $classNames = array_map(static function ($classPath) {
            return basename($classPath, '.php');
        }, $classPaths);
        return array_filter(
            $classNames,
            [$this->reflectionProvider, 'hasClass']
        );
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

    private function wrapBehaviorMethod(
        MethodReflection $methodReflection
    ): MethodReflection {
        return new ModelBehaviorMethodWrapper($methodReflection);
    }

    /**
     * @param MethodReflection|ReflectionMethod $methodReflection
     */
    private function getMethodReflectionName($methodReflection): string
    {
        return $methodReflection->getName();
    }
}
