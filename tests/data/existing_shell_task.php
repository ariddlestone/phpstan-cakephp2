<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicShell $shell */
$task = $shell->Basic;

assertType('BasicTask', $task);
