<?php

namespace ARiddlestone\PHPStanCakePHP2\Test;

use PHPStan\Testing\TypeInferenceTestCase;

class ModelExtensionsTest extends TypeInferenceTestCase
{
    /**
     * @return mixed[]
     */
    public function dataFileAsserts(): iterable
    {
        yield from $this->gatherAssertTypes(__DIR__ . '/data/core_model_behavior.php');
        yield from $this->gatherAssertTypes(__DIR__ . '/data/custom_model_behavior.php');
        yield from $this->gatherAssertTypes(__DIR__ . '/data/invalid_model_property.php');
        yield from $this->gatherAssertTypes(__DIR__ . '/data/existing_model_model.php');
    }

    /**
     * @dataProvider dataFileAsserts
     * @param mixed $args
     */
    public function testModelExtensions(string $assertType, string $file, ...$args): void
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
