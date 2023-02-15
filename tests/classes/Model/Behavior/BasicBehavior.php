<?php

class BasicBehavior extends ModelBehavior
{
    public function behaviorMethod(Model $model, string $string): string
    {
        return 'string: ' . $string;
    }
}
