<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicController $controller */
$component = $controller->BasicComponent;

assertType('BasicComponent', $component);
