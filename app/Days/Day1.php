<?php
namespace App\Days;

use App\Helpers\DayConstructor;
use App\Interfaces\DayInterface;
use Illuminate\Support\Collection;

class Day1 implements DayInterface
{
    public Collection $lists;

    public function __construct($lists = null)
    {
        $this->lists = DayConstructor::construct($lists, 1);
    }

    public function part1(): int
    {
        $leftList = [];
        $rightList = [];
        foreach ($this->lists as $list){
            $values = str($list)->explode('   ');
            $leftList[] = $values[0];
            $rightList[] = $values[1];
        }
        sort($leftList);
        sort($rightList);

        $differences = 0;
        for($i = 0; $i < count($leftList); $i++){
            $difference = $leftList[$i]-$rightList[$i];
            if($difference < 0){
                $difference = $difference*-1;
            }
            $differences += $difference;
        }

        return $differences;
    }

    public function part2(): int
    {
        $leftList = collect();
        $rightList = collect();
        foreach ($this->lists as $list){
            $values = str($list)->explode('   ');
            $leftList->push(['number' => $values[0]]);
            $rightList->push(['number' => $values[1]]);
        }

        $similarityScore = 0;

        foreach ($leftList as $list){
            $similarityScore += $list['number']*$rightList->where('number', $list['number'])->count();
        }

        return $similarityScore;
    }
}
