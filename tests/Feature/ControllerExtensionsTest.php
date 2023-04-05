<?php

namespace ARiddlestone\PHPStanCakePHP2\Test\Feature;

use PHPStan\Testing\TypeInferenceTestCase;

class ControllerExtensionsTest extends TypeInferenceTestCase
{
    /**
     * @return mixed[]
     */
    public function dataFileAsserts(): iterable
    {
        yield from $this->gatherAssertTypes(__DIR__ . '/data/existing_controller_model.php');
        yield from $this->gatherAssertTypes(__DIR__ . '/data/existing_controller_component.php');
        yield from $this->gatherAssertTypes(__DIR__ . '/data/invalid_controller_property.php');
    }

    /**
     * @dataProvider dataFileAsserts
     * @param mixed $args
     */
    public function testControllerExtensions(string $assertType, string $file, ...$args): void
    {
        $this->assertFileAsserts($assertType, $file, ...$args);
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [
            __DIR__ . '/data/phpstan.neon',
        ];
    }
}
