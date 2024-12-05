<?php
namespace App\Days;

use App\Helpers\DayConstructor;
use App\Interfaces\DayInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Day3 implements DayInterface
{
    public string $memory;

    public function __construct($memory = null)
    {
        $this->memory = DayConstructor::construct($memory, 3, 'string');
    }

    public function part1(): int
    {
        $str = Str::of($this->memory);
        $result = 0;
        while($str->contains("mul(")){
            $occurence = $str->betweenFirst("mul(", ")");
            $parts = explode(',', $occurence, 2);
            if(is_numeric($parts[0]) && is_numeric($parts[1])){
                $result += $parts[0]*$parts[1];
            }
            $str = $str->replaceFirst('mul(', '');
        }
        return $result;
    }

    public function part2(): int
    {
        $str = Str::of($this->memory);
        $result = 0;
        $doCalc = true;
        while($str->contains("mul(")){
            $occurence = $str->betweenFirst("mul(", ")");

            $beforeOccurence = $str->before("mul(" . $occurence . ")");

            // Tarkista, onko "don't()" tai "do()" vaikuttamassa
            if ($beforeOccurence->contains("don't()") && !$beforeOccurence->contains("do()")) {
                $doCalc = false;
            }

            if ($beforeOccurence->contains("do()") && $beforeOccurence->contains("don't()")) {
                // "do()" esiintyy myöhemmin kuin "don't()"
                $lastDoPos = $beforeOccurence->lastIndexOf("do()");
                $lastDontPos = $beforeOccurence->lastIndexOf("don't()");
                $doCalc = $lastDoPos > $lastDontPos;
            } elseif ($beforeOccurence->contains("do()")) {
                $doCalc = true;
            }

            $parts = explode(',', $occurence, 2);
            if(is_numeric($parts[0]) && is_numeric($parts[1])){
                if($doCalc){
                    $result += $parts[0]*$parts[1];
                }
            }
            if($beforeOccurence->contains("don't()")){
                $str = $str->replaceFirst("don't()", '');
            }
            if($beforeOccurence->contains("do()")){
                $str = $str->replaceFirst("do()", '');
            }
            $str = $str->replaceFirst('mul(', '');
        }
        return $result;
    }
}
