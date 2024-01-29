<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var SameAsModelController $controller */
$component = $controller->Basic;

assertType('BasicComponent', $component);
