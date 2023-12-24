<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var SameAsModelController $controller */
$component = $controller->SameAsModel->sameMethod();

assertType('int', $component);

/** @var SameAsModelController $controller */
$component = $controller->BasicComponent;

assertType('BasicComponent', $component);
