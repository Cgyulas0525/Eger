<?php

namespace App\Actions;

class GetBeginDate
{
    public function handle($witch) {
        if ($witch == 'year') {
            $begin = date('Y-m-d', strtotime('first day of January'));
        } elseif ($witch == 'mount') {
            $begin = date('Y-m-d', strtotime('first day of this month'));
        } elseif ($witch == 'week') {
            $begin = date('Y-m-d', strtotime('Monday this week'));
        }
        return $begin;
    }
}
