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
final class ClassModelsExtension implements
    PropertiesClassReflectionExtension
{
    private const CLASSES_WITH_MODEL_PROPERTIES = [
        'Controller',
        'Model',
        'Shell',
    ];

    private ReflectionProvider $reflectionProvider;

    public function __construct(ReflectionProvider $reflectionProvider)
    {
        $this->reflectionProvider = $reflectionProvider;
    }

    public function hasProperty(
        ClassReflection $classReflection,
        string $propertyName
    ): bool {
        return array_filter(self::CLASSES_WITH_MODEL_PROPERTIES, [$classReflection, 'is'])
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
