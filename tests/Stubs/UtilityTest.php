<?php

namespace ARiddlestone\PHPStanCakePHP2\Test\Stubs;

use PHPStan\Testing\TypeInferenceTestCase;

class UtilityTest extends TypeInferenceTestCase
{
    /**
     * @return mixed[]
     */
    public function dataFileAsserts(): iterable
    {
        yield from $this->gatherAssertTypes(__DIR__ . '/../data/stubs/class_registry_init.php');
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
            __DIR__ . '/../data/phpstan.neon',
        ];
    }
}
