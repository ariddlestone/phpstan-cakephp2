<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var ModelWithoutBehaviors $model */
$result = $model->behaviorMethod('a string!');

assertType('*ERROR*', $result);
