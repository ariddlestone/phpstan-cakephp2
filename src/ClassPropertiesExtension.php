<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Reflection\ReflectionProvider;

abstract class ClassPropertiesExtension implements
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
        $propertyClassName = $this->getClassNameFromPropertyName($propertyName);

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
            $this->getClassNameFromPropertyName($propertyName),
            $classReflection
        );
    }

    /**
     * Get the class name of the type of property.
     */
    abstract protected function getPropertyParentClassName(): string;

    /**
     * Get the class names which can contain the property.
     *
     * @return array<string>
     */
    abstract protected function getContainingClassNames(): array;

    /**
     * Return the class name from the property name.
     */
    abstract protected function getClassNameFromPropertyName(
        string $propertyName
    ): string;
}
