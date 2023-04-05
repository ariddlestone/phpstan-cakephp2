<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicComponent $parentComponent */
$childComponent = $parentComponent->Second;

assertType('SecondComponent', $childComponent);
