<?php

declare(strict_types=1);

namespace PHPStanCakePHP2;

use Exception;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\ReflectionProvider;

/**
 * Adds methods to {@link Model}s from {@link ModelBehavior} classes.
 */
final class ModelBehaviorsExtension implements MethodsClassReflectionExtension
{
    private ReflectionProvider $reflectionProvider;

    /**
     * @var array<string>
     */
    private array $behaviorPaths;

    /**
     * @var array<MethodReflection>|null
     */
    private ?array $behaviorMethods = null;

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
                ),
                true
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
                $modelBehaviorMethodExtractor =
                    new ModelBehaviorMethodExtractor($classReflection);
                $this->behaviorMethods = array_merge(
                    $this->behaviorMethods,
                    $modelBehaviorMethodExtractor->getModelBehaviorMethods()
                );
            }
        }
        return $this->behaviorMethods;
    }

    /**
     * Returns the name of a method from its reflection.
     */
    private function getMethodReflectionName(
        MethodReflection $methodReflection
    ): string {
        return $methodReflection->getName();
    }
}
