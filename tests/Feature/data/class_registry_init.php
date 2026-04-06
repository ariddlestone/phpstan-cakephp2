<?php

declare(strict_types=1);

use function PHPStan\Testing\assertType;

$class = ClassRegistry::init('ModelWithoutBehaviors');
assertType('ModelWithoutBehaviors', $class);

$notClass = ClassRegistry::init('NotAClass');
assertType('bool|object', $notClass);

$modelWithoutClass = ClassRegistry::init('TableWithoutModel');
assertType('Model', $modelWithoutClass);
