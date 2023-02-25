<?php

namespace ARiddlestone\PHPStanCakePHP2\Test;

use PHPStan\Testing\TypeInferenceTestCase;

class ShellExtensionsTest extends TypeInferenceTestCase
{
    /**
     * @return mixed[]
     */
    public function dataFileAsserts(): iterable
    {
        yield from $this->gatherAssertTypes(__DIR__ . '/data/existing_shell_model.php');
        yield from $this->gatherAssertTypes(__DIR__ . '/data/existing_shell_task.php');
        yield from $this->gatherAssertTypes(__DIR__ . '/data/invalid_shell_property.php');
    }

    /**
     * @dataProvider dataFileAsserts
     * @param mixed $args
     */
    public function testShellExtensions(string $assertType, string $file, ...$args): void
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
