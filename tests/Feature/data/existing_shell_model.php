<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicShell $shell */
$model = $shell->BasicModel;

assertType('BasicModel', $model);
