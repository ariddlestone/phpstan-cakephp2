<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var ModelWithBehaviors $model */
$result = $model->behaviorMethod('a string!');

assertType('string', $result);
