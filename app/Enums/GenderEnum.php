<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\From;

enum GenderEnum: string
{
    use InvokableCases, Options, Names, Values, From;

    case MEN = 'Férfi';
    case WOMEN = 'Nő';

    public static function getValue($witch)
    {
        return match($witch)
        {
            0 => self::MEN->value,
            1 => self::WOMEN->value,
        };
    }
}

