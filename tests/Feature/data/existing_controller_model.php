<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicController $controller */
$model = $controller->BasicModel;

assertType('BasicModel', $model);
