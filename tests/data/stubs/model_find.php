<?php

declare(strict_types=1);

use function PHPStan\Testing\assertType;

/** @var Model $model */

$findBy = $model->findBySomeField(1);
assertType('array', $findBy);

$findAllBy = $model->findAllBySomeField('Bob');
assertType('array', $findAllBy);

$findCount = $model->find('count');
assertType('int', $findCount);
