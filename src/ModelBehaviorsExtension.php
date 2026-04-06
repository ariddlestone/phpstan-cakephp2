<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use Exception;
use Model;
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Scalar\String_;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\ReflectionProvider;

/**
 * Adds methods to {@link Model}s from {@link ModelBehavior} classes.
 */
final class ModelBehaviorsExtension implements MethodsClassReflectionExtension
{
    /**
     * @var ReflectionProvider
     */
    private ReflectionProvider $reflectionProvider;

    /**
     * @var array<string>
     */
    private array $behaviorPaths;

    /**
     * @var array<string, list<MethodReflection>>
     */
    private array $behaviorMethods = [];

    /**
     * @var array<class-string, list<string>>
     */
    private array $modelBehaviorNames = [];

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
                    fn(MethodReflection $methodReflection) => $methodReflection->getName(),
                    $this->getModelBehaviorMethods($classReflection)
                )
            );
    }

    /**
     * @throws Exception
     */
    public function getMethod(
        ClassReflection $classReflection,
        string $methodName
    ): MethodReflection {
        $methodReflections = array_filter(
            $this->getModelBehaviorMethods($classReflection),
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
     * @param ClassReflection $modelReflection
     * @return list<MethodReflection>
     */
    private function getModelBehaviorMethods(ClassReflection $modelReflection): array
    {
        $behaviorNames = $this->getModelBehaviorNames($modelReflection);
        return array_merge(...array_map([$this, 'getBehaviorMethods'], $behaviorNames));
    }

    /**
     * @param ClassReflection $modelReflection
     * @return list<string>
     */
    private function getModelBehaviorNames(ClassReflection $modelReflection): array
    {
        if (! array_key_exists($modelReflection->getName(), $this->modelBehaviorNames)) {
            $phpReflection = $modelReflection->getNativeReflection();
            if (!$phpReflection->hasProperty('actsAs')) {
                // TODO merge parent class actsAs?
                return [];
            }
            $actsAs = $phpReflection->getProperty('actsAs')->getDefaultValueExpression();
            if (!$actsAs instanceof Array_) {
                return [];
            }

            $this->modelBehaviorNames[$modelReflection->getName()] = array_values(
                array_filter(
                    array_map(
                        fn(ArrayItem $item) => $item->value instanceof String_ ? $item->value->value : null,
                        $actsAs->items
                    )
                )
            );
        }

        return $this->modelBehaviorNames[$modelReflection->getName()];
    }

    /**
     * Gets all behavior methods for a given behavior name.
     *
     * @param string $behaviorName
     * @return list<MethodReflection>
     * @throws Exception
     */
    private function getBehaviorMethods(string $behaviorName): array
    {
        if (! array_key_exists($behaviorName, $this->behaviorMethods)) {
            $this->behaviorMethods[$behaviorName] = [];

            $classReflectionFinder = new ClassReflectionFinder(
                $this->reflectionProvider
            );
            $reflectionClass = array_find(
                $classReflectionFinder->getClassReflections(
                    $this->behaviorPaths,
                    $behaviorName.'Behavior',
                ),
                fn(ClassReflection $class) => $class->getName() === $behaviorName.'Behavior',
            );
            if (!$reflectionClass) {
                return [];
            }
            $modelBehaviorMethodExtractor =
                new ModelBehaviorMethodExtractor($reflectionClass);
            $this->behaviorMethods[$behaviorName] = array_values($modelBehaviorMethodExtractor->getModelBehaviorMethods());
        }

        return $this->behaviorMethods[$behaviorName];
    }
}
