<?php

namespace ARiddlestone\PHPStanCakePHP2\Test;

use PHPStan\Testing\TypeInferenceTestCase;

class ControllerModelsExtensionTest extends TypeInferenceTestCase
{
    /**
     * @return mixed[]
     */
    public function dataFileAsserts(): iterable
    {
        yield from $this->gatherAssertTypes(__DIR__ . '/data/existing_controller_model.php');
    }

    /**
     * @dataProvider dataFileAsserts
     * @covers \ARiddlestone\PHPStanCakePHP2\ControllerModelsExtension
     * @param mixed $args
     */
    public function testControllerModelsExtension(string $assertType, string $file, ...$args): void
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
