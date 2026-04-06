# Models Extension

CakePHP 2 models have the following magic methods/properties which need mapping for PHPStan:

* [Associations](#associations)
* [Behavior Methods](#behavior-methods)
* [Behavior Mapped Methods](#behavior-mapped-methods)
* [Custom Find Types](#custom-find-types)
* [Find By](#find-by)
* [Find All By](#find-all-by)
* [Find Custom By](#find-custom-by)

## Associations

All models listed in `$hasOne`, `$hasMany`, `$belongsTo`, and `$hasAndBelongsToMany` are available at
`$this->{$modelName}`.

See https://book.cakephp.org/2.x/models/associations-linking-models-together.html.

TODO: Need to limit models to those listed in the model's `$hasOne`, `$hasMany`, `$belongsTo`, and
`$hasAndBelongsToMany` properties

## Behavior Methods

All methods from behaviors listed in `$actsAs` are available in this model (without the first `$model` parameter).
Methods listed in `AppModel` are also available.

See https://book.cakephp.org/2.x/models/behaviors.html.

TODO: Need to load behaviors from the `AppModel::$actsAs`

## Behavior Mapped Methods

All methods from behaviors listed in `$mapMethods` are available in this model as magic methods (without the first
`$model` parameter).

See https://book.cakephp.org/2.x/models/behaviors.html#mapped-methods.

TODO: Need to load implement

## Custom Find Types

All find types listed in `$findMethods` cause the `find()` method to return the type returned by their respective
`_find{$type}` method.

See https://book.cakephp.org/2.x/models/retrieving-your-data.html#creating-custom-find-types.

TODO: Need to implement

## Find By

Methods like `findBy{$fieldName}($fieldValue, $fields, $order)` or
`findBy{$field1Name}And{$field2Name}($field1Value, $field2Name, $fields, $order)` work like `find('first')`.

See https://book.cakephp.org/2.x/models/retrieving-your-data.html#findby.

TODO: Need to implement

## Find All By

Methods like `findAllBy{$fieldName}($fieldValue, $fields, $order)` or
`findAllBy{$field1Name}And{$field2Name}($field1Value, $field2Name, $fields, $order)` work like `find('all')`.

See https://book.cakephp.org/2.x/models/retrieving-your-data.html#findallby.

TODO: Need to implement (probably a specific case of [Find Custom By](#find-custom-by))

## Find Custom By

Methods like `findCustomBy{$fieldName}($fieldValue, $fields, $order)` or
`findCustomBy{$field1Name}And{$field2Name}($field1Value, $field2Name, $fields, $order)` work like `find('custom')`.

See https://book.cakephp.org/2.x/models/retrieving-your-data.html#custom-magic-finders.

TODO: Need to implement
