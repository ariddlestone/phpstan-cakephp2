<?php

namespace ARiddlestone\PHPStanCakePHP2\Test\Stubs;

use PHPStan\Testing\TypeInferenceTestCase;

class ModelTest extends TypeInferenceTestCase
{
    /**
     * @return mixed[]
     */
    public function dataFileAsserts(): iterable
    {
        yield from $this->gatherAssertTypes(__DIR__ . '/../data/stubs/model_find.php');
    }

    /**
     * @dataProvider dataFileAsserts
     * @param mixed $args
     */
    public function testModelStubs(string $assertType, string $file, ...$args): void
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
