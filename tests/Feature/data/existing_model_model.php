<?php

declare(strict_types = 1);

use function PHPStan\Testing\assertType;

/** @var BasicModel $model */
$secondModel = $model->SecondModel;

assertType('SecondModel', $secondModel);
