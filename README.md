# PHPStan-CakePHP2
PHPStan extensions to help test CakePHP 2 projects with PHPStan

## Requirements

* PHP 7.4
* phpstan/phpstan 1.9+
* cakephp/cakephp 2.x

## Installation

Installation is best done through composer:
```shell
composer require --dev ariddlestone/phpstan-cakephp2
```

You will need to make sure the extension is included in your phpstan config:
```yaml
# phpstan.neon
includes:
  - vendor/ariddlestone/phpstan-cakephp2/extension.neon
```

If you have behavior classes in odd locations (perhaps in a vendor directory) you will need to add those locations to
your configuration. For example:
```yaml
# phpstan.neon
parameters:
  ModelBehaviorsExtension:
    behaviorPaths:
      - vendor/my-vendor/my-plugin/src/Model/Behavior/*.php
```
See `extension.neon` for the default list of behavior locations.

## Features

The following features are added to PHPStan:

* Treat behavior methods as extra methods on all models (`$model->behaviorMethod()`)
* Treat controller properties named after model classes as instances of those classes (`$controller->Model`)
* Treat controller properties named after component classes as instances of those classes (`$controller->Component`)
* Treat component properties names after component classes as instances of those classes (`$component->Component`)
* Treat `ClassRegistry::init($className)` as returning an instance of `$className` where possible
