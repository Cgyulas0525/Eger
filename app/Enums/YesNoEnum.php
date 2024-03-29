<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\From;

enum YesNoEnum: string
{
    use InvokableCases, Options, Names, Values, From;

    case NO = 'Nem';
    case YES = 'Igen';

    public static function getValue($witch)
    {
        return match($witch)
        {
            0 => self::NO->value,
            1 => self::YES->value,
        };
    }
}

