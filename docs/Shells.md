# Shells Extension

Shells have the following magic properties which need mapping for PHPStan:

* [Models](#models)
* [Tasks](#tasks)

## Models

See https://book.cakephp.org/2.x/console-and-shells.html#using-models-in-your-shells.

All models listed in `$uses` are available at `$this->{$modelName}`.

TODO: Need to limit models to those listed in the shell's `$uses` property

## Tasks

See https://book.cakephp.org/2.x/console-and-shells.html#shell-tasks.

All tasks listed in `$tasks` are available at `$this->{$taskName}`.

TODO: Need to limit tasks to those listed in the shell's `$tasks` property
