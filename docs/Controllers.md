# Controllers Extension

Controllers have the following magic properties which need mapping for PHPStan:

* [Models](#models)
* [Components](#components)

## Models

All models listed in `$uses` are available at `$this->{$modelName}`. If `$uses` is not set, include the primary model
for the controller. If `uses` is not `false` models listed in `AppController::$uses` are also available.

See https://book.cakephp.org/2.x/controllers.html#components-helpers-and-uses.

TODO: Need to limit models to those listed in the controller's `$uses` property

## Components

All components listed in `$components` are available at `$this->{$componentName}`. If `$components` is not `false` then
components listed in `AppController::$components` are also available.

See https://book.cakephp.org/2.x/controllers.html#components-helpers-and-uses.

TODO: Need to limit components to those listed in the controller's `$components` property

## Load Model

`loadModel($modelClass)` sets `$this->{$modelClass}` to be an instance of that model class.

TODO: Need to implement, or (if not practical to implement) add a rule to flag its usage as a failure so that it is either
set in `$uses` or replaced with a call to `ClassRegistry::init($modelClass)` to get an instance.
