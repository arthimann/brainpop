<?php
namespace App\School\Period;

interface PeriodContract
{
    public function store(array $details): object;
}
