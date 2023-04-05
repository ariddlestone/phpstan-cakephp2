<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicShell $shell */
$result = $shell->NotAProperty;

assertType('*ERROR*', $result);
