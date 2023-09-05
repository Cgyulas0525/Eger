<?php

namespace App\Actions;

class GetEndDate
{
    public function handle($witch) {
        if ($witch == 'year') {
            $end   = date('Y-m-d', strtotime('last day of December'));
        } elseif ($witch == 'mount') {
            $end   = date('Y-m-d', strtotime('last day of this month'));
        } elseif ($witch == 'week') {
            $end   = date('Y-m-d', strtotime('Sunday this week'));
        }
        return $end;
    }
}
