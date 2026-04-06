<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var ModelWithoutBehaviors $model */
$secondModel = $model->SecondModel;

assertType('SecondModel', $secondModel);
