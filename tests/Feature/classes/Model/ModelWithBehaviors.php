<?php

class ModelWithBehaviors extends Model
{
    /**
     * @var list<string>
     */
    public $actsAs = [
        'Basic',
        'Translate',
    ];
}
