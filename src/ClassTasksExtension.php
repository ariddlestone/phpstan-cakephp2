<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Reflection\ReflectionProvider;

/**
 * Adds {@link Model}s as properties to {@link Shell}s.
 */
final class ClassTasksExtension implements
    PropertiesClassReflectionExtension
{
    private ReflectionProvider $reflectionProvider;

    public function __construct(ReflectionProvider $reflectionProvider)
    {
        $this->reflectionProvider = $reflectionProvider;
    }

    public function hasProperty(
        ClassReflection $classReflection,
        string $propertyName
    ): bool {
        $propertyClassName = $this->getClassName($propertyName);

        return array_filter(
            $this->getContainingClassNames(),
            [$classReflection, 'is']
        )
            && $this->reflectionProvider->hasClass($propertyClassName)
            && $this->reflectionProvider->getClass($propertyClassName)
            ->is($this->getPropertyParentClassName());
    }

    public function getProperty(
        ClassReflection $classReflection,
        string $propertyName
    ): PropertyReflection {
        return new PublicReadOnlyPropertyReflection(
            $this->getClassName($propertyName),
            $classReflection
        );
    }

    /**
     * @return array<string>
     */
    private function getContainingClassNames(): array
    {
        return ['Shell'];
    }

    private function getPropertyParentClassName(): string
    {
        return 'Shell';
    }

    private function getClassName(string $propertyName): string
    {
        return $propertyName . 'Task';
    }
}
