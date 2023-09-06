<?php

namespace App\Actions;

class GetEndDate
{
    public function handle($witch): string
    {
        return match ($witch) {
            'year' => now()->lastOfYear()->toDateString(),
            'month' => now()->lastOfMonth()->toDateString(),
            'week' => now()->endOfWeek()->toDateString(),
        };
    }
}
