<?php

namespace ARiddlestone\PHPStanCakePHP2;

use Exception;
use PHPStan\Analyser\ScopeFactory;
use PHPStan\BetterReflection\Reflection\Adapter\ReflectionMethod;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ExtendedMethodReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\ObjectType;

class ModelBehaviorsExtension implements MethodsClassReflectionExtension
{
    /**
     * @var ReflectionProvider
     */
    private $reflectionProvider;

    /**
     * @var string[]
     */
    private $behaviorPaths;

    /**
     * @var MethodReflection[]|null
     */
    private $behaviorMethods = null;

    /**
     * @param string[] $behaviorPaths
     */
    public function __construct(ReflectionProvider $reflectionProvider, array $behaviorPaths)
    {
        $this->reflectionProvider = $reflectionProvider;
        $this->behaviorPaths = $behaviorPaths;
    }

    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        return $classReflection->is('Model')
            && count(
                array_filter(
                    $this->getBehaviorMethods(),
                    function (MethodReflection $methodReflection) use ($methodName) {
                        return $methodReflection->getName() === $methodName;
                    }
                )
            ) > 0;
    }

    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        $methodReflections = array_filter(
            $this->getBehaviorMethods(),
            function (MethodReflection $methodReflection) use ($methodName) {
                return $methodReflection->getName() === $methodName;
            }
        );
        if (! $methodReflections) {
            throw new Exception('Method not found');
        }
        return reset($methodReflections);
    }

    /**
     * @return MethodReflection[]
     */
    private function getBehaviorMethods(): array
    {
        if ($this->behaviorMethods === null) {
            $classPaths = [];
            foreach ($this->behaviorPaths as $path) {
                $classPaths = array_merge($classPaths, glob($path) ?: []);
            }
            $classNames = array_map(function ($classPath) {
                return basename($classPath, '.php');
            }, $classPaths);
            $classNames = array_filter($classNames, [$this->reflectionProvider, 'hasClass']);
            $classReflections = array_map([$this->reflectionProvider, 'getClass'], $classNames);
            /** @var ClassReflection[] $classReflections */
            $classReflections = array_filter($classReflections, function (ClassReflection $classReflection) {
                return $classReflection->is('ModelBehavior');
            });
            $this->behaviorMethods = [];
            foreach ($classReflections as $classReflection) {
                $this->behaviorMethods = array_merge($this->behaviorMethods, $this->getModelBehaviorMethods($classReflection));
            }
        }
        return $this->behaviorMethods;
    }

    /**
     * Returns all methods for the class which have a first parameter of Model, with that parameter removed.
     *
     * Also filters out private, protected, and static methods.
     *
     * @return MethodReflection[]
     */
    private function getModelBehaviorMethods(ClassReflection $classReflection): array
    {
        $methodNames = array_map(function (ReflectionMethod $methodReflection) {
            return $methodReflection->getName();
        }, $classReflection->getNativeReflection()->getMethods());
        /** @var ExtendedMethodReflection[] $methodReflections */
        $methodReflections = array_filter(
            array_map([$classReflection, 'getNativeMethod'], $methodNames),
            function (ExtendedMethodReflection $methodReflection) {
                return $methodReflection->isPublic()
                    && !$methodReflection->isStatic()
                    && array_filter(
                        $methodReflection->getVariants(),
                        function (ParametersAcceptor $parametersAcceptor) {
                            $parameters = $parametersAcceptor->getParameters();
                            /** @var ParameterReflection|null $firstParameter */
                            $firstParameter = array_shift($parameters);
                            return $firstParameter
                                && ! $firstParameter->getType()->isSuperTypeOf(new ObjectType('Model'))->no();
                        }
                    );
            }
        );
        return array_map(function (ExtendedMethodReflection $methodReflection) {
            return new ModelBehaviorMethodWrapper($methodReflection);
        }, $methodReflections);
    }
}
