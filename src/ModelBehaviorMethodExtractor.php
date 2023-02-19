<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use PHPStan\BetterReflection\Reflection\Adapter\ReflectionMethod;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ExtendedMethodReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\Type\ObjectType;

final class ModelBehaviorMethodExtractor
{
    /**
     * @var ClassReflection
     */
    private $classReflection;

    public function __construct(ClassReflection $classReflection)
    {
        $this->classReflection = $classReflection;
    }

    /**
     * Returns all methods for the class which have a first parameter of Model,
     * with that parameter removed.
     *
     * Also filters out private, protected, and static methods.
     *
     * @return array<MethodReflection>
     */
    public function getModelBehaviorMethods(): array
    {
        $methodNames = array_map(
            [$this, 'getMethodReflectionName'],
            $this->classReflection->getNativeReflection()->getMethods()
        );
        /** @var array<ExtendedMethodReflection> $methodReflections */
        $methodReflections = array_filter(
            array_map(
                [$this->classReflection, 'getNativeMethod'],
                $methodNames
            ),
            [$this, 'filterBehaviorMethods']
        );
        return array_map([$this, 'wrapBehaviorMethod'], $methodReflections);
    }

    /**
     * Returns the name of a method from its reflection.
     */
    private function getMethodReflectionName(
        ReflectionMethod $methodReflection
    ): string {
        return $methodReflection->getName();
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
}
