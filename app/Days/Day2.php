<?php
namespace App\Days;

use App\Helpers\DayConstructor;
use App\Interfaces\DayInterface;
use Illuminate\Support\Collection;

class Day2 implements DayInterface
{
    public Collection $reports;

    public function __construct($reports = null)
    {
        $this->reports = DayConstructor::construct($reports, 2);
    }

    public function part1(): int
    {
        $safeReports = 0;
        foreach ($this->reports as $report){
            $levels = str($report)->explode(' ')->toArray();

            $safe = $this->checkLevels($levels);
            if($safe){
                $safeReports++;
            }

        }

        return $safeReports;
    }

    public function part2(): int
    {
        $safeReports = 0;
        foreach ($this->reports as $report){
            $levels = str($report)->explode(' ')->toArray();

            $safe = $this->checkLevels($levels);

            for ($i = 0; $i < count($levels); $i++) {
                $copy = $levels;
                unset($copy[$i]);
                $copy = array_values($copy);
                if ($this->checkLevels($copy)) {
                    $safe = true;
                    break;
                }
            }

            if($safe){
                $safeReports++;
            }

        }

        return $safeReports;
    }

    private function checkLevels($levels)
    {
        $safe = true;
        $diff_prev = 0;
        for ($i = 1; $i < count($levels); $i++){
            $diff = $levels[$i] - $levels[$i - 1];

            if (abs($diff) < 1 || abs($diff) > 3) {
                $safe = false;
            }

            if ($i >= 2 && $diff > 0 != $diff_prev > 0) {
                $safe = false;
            }

            $diff_prev = $diff;
        }

        return $safe;
    }
}
