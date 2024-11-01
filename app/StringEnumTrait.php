<?php

namespace App;

trait StringEnumTrait
{
    public static function casesWithValues(): array
    {
        $return = [];
        foreach (static::cases() as $case) {
            $return[$case->name] = $case->value;
        }

        return $return;
    }
}
