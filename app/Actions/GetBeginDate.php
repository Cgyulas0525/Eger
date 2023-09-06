<?php

namespace App\Actions;

class GetBeginDate
{
    public function handle($witch): string
    {
        return match($witch) {
            'year' => now()->firstOfYear()->toDateString(),
            'month' => now()->firstOfMonth()->toDateString(),
            'week' => now()->startOfWeek()->toDateString(),
        };
    }
}
