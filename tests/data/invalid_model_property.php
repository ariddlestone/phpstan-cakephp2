<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicModel $model */
$result = $model->unknownMethod('One', 'Two');

assertType('*ERROR*', $result);
