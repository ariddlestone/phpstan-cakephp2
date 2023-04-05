<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicController $controller */
$property = $controller->stdClass;

assertType('*ERROR*', $property);
