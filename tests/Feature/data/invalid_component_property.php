<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicComponent $component */
$property = $component->stdClass;

assertType('*ERROR*', $property);
