<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Reflection\ReflectionProvider;

/**
 * Supports discovering models in controllers.
 */
final class ControllerComponentsExtension implements
    PropertiesClassReflectionExtension
{
    /**
     * @var ReflectionProvider
     */
    private $reflectionProvider;

    public function __construct(ReflectionProvider $reflectionProvider)
    {
        $this->reflectionProvider = $reflectionProvider;
    }

    public function hasProperty(
        ClassReflection $classReflection,
        string $propertyName
    ): bool {
        if (! $classReflection->is('Controller')) {
            return false;
        }

        if (! $this->reflectionProvider->hasClass($propertyName)) {
            return false;
        }

        if (
            ! $this->reflectionProvider
                ->getClass($propertyName)
                ->is('Component')
        ) {
            return false;
        }

        return true;
    }

    public function getProperty(
        ClassReflection $classReflection,
        string $propertyName
    ): PropertyReflection {
        return new ControllerPropertyReflection(
            $propertyName,
            $classReflection
        );
    }
}
