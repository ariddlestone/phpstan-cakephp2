<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicController $controller */
$component = $controller->Components->load('Basic');

assertType('BasicComponent', $component);
