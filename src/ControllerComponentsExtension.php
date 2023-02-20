<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Reflection\ReflectionProvider;

/**
 * Adds {@link Component}s as properties to {@link Controller}s.
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

        $className = $this->getClassName($propertyName);

        if (! $this->reflectionProvider->hasClass($className)) {
            return false;
        }

        if (
            ! $this->reflectionProvider
                ->getClass($className)
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
        return new PublicReadOnlyPropertyReflection(
            $this->getClassName($propertyName),
            $classReflection
        );
    }

    private function getClassName(string $propertyName): string
    {
        return $propertyName . 'Component';
    }
}
