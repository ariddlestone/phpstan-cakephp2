<?php

namespace ARiddlestone\PHPStanCakePHP2;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Reflection\ReflectionProvider;

final class ComponentComponentsExtension implements
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
        if (! $classReflection->is('Component')) {
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
