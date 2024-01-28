<?php

declare(strict_types=1);

namespace PHPStanCakePHP2;

final class ClassComponentsExtension extends ClassPropertiesExtension
{
    protected function getPropertyParentClassName(): string
    {
        return 'Component';
    }

    /**
     * @return array<string>
     */
    protected function getContainingClassNames(): array
    {
        return [
            'Controller',
            'Component',
        ];
    }

    protected function getClassNameFromPropertyName(
        string $propertyName
    ): string {
        return $propertyName . 'Component';
    }
}
