<?php

class AppSchema extends CakeSchema
{
    /**
     * @var array<string, mixed>
     */
    public $basic_models = array(
        'id' => array(
            'type' => 'integer',
            'null' => false,
            'default' => null,
            'length' => 10,
            'key' => 'primary',
        ),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
    );

    /**
     * @var array<string, mixed>
     */
    public $table_without_models = array(
        'id' => array(
            'type' => 'integer',
            'null' => false,
            'default' => null,
            'length' => 10,
            'key' => 'primary',
        ),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
    );
}
