<?php

declare(strict_types=1);

use function PHPStan\Testing\assertType;

$class = ClassRegistry::init('BasicModel');
assertType('BasicModel', $class);

$notClass = ClassRegistry::init('NotAClass');
assertType('bool|object', $notClass);

//$modelWithoutClass = ClassRegistry::init('TableWithoutModel');
//assertType('Model', $modelWithoutClass);
