<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Scalar\String_;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Reflection\ReflectionProvider;

final class ClassComponentsExtension implements PropertiesClassReflectionExtension
{
    private ReflectionProvider $reflectionProvider;

    public function __construct(ReflectionProvider $reflectionProvider)
    {
        $this->reflectionProvider = $reflectionProvider;
    }

    public function hasProperty(ClassReflection $classReflection, string $propertyName): bool
    {
        if (!array_filter($this->getContainingClassNames(), [$classReflection, 'is'])) {
            return false;
        }

        $isDefinedInComponentsProperty = (bool) array_filter(
            $this->getDefinedComponentsAsList($classReflection),
            static fn (string $componentName): bool => $componentName === $propertyName
        );

        if (!$isDefinedInComponentsProperty) {
            return false;
        }

        $propertyClassName = $this->getClassNameFromPropertyName($propertyName);

        return $this->reflectionProvider->hasClass($propertyClassName)
            && $this->reflectionProvider->getClass($propertyClassName)
                ->is('Component');
    }

    public function getProperty(ClassReflection $classReflection, string $propertyName): PropertyReflection
    {
        return new PublicReadOnlyPropertyReflection(
            $this->getClassNameFromPropertyName($propertyName),
            $classReflection
        );
    }

    /**
     * @return array<string>
     */
    private function getContainingClassNames(): array
    {
        return [
            'Controller',
            'Component',
        ];
    }

    private function getClassNameFromPropertyName(string $propertyName): string
    {
        return $propertyName . 'Component';
    }

    /**
     * @return list<string>
     */
    private function getDefinedComponentsAsList(ClassReflection $classReflection): array
    {
        $definedComponents = [];

        foreach (array_merge([$classReflection], $classReflection->getParents()) as $class) {
            if (!$class->hasProperty('components')) {
                continue;
            }

            $defaultValue = $class->getNativeProperty('components')
                ->getNativeReflection()
                ->getDefaultValueExpression();

            if (!$defaultValue instanceof Array_) {
               continue;
            }

            foreach ($defaultValue->items as $item) {
                if ($item !== null && $item->value instanceof String_) {
                    $definedComponents[] = $item->value->value;
                }
            }
        }

        return $definedComponents;
    }
}
