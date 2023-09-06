<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\From;

enum TrueFalseEnum: string
{
    use InvokableCases, Options, Names, Values, From;

    case FALSE = 'Hamis';
    case TRUE = 'Igaz';

    public static function getValue($witch)
    {
        return match($witch)
        {
            0 => self::FALSE->value,
            1 => self::TRUE->value,
        };
    }
}

