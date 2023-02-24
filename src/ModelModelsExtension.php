<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Reflection\ReflectionProvider;

/**
 * Adds {@link Model}s as properties to {@link Model}s.
 */
final class ModelModelsExtension implements
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
        return $classReflection->is('Model')
            && $this->reflectionProvider->hasClass($propertyName)
            && $this->reflectionProvider->getClass($propertyName)->is('Model');
    }

    public function getProperty(
        ClassReflection $classReflection,
        string $propertyName
    ): PropertyReflection {
        return new PublicReadOnlyPropertyReflection(
            $propertyName,
            $classReflection
        );
    }
}
