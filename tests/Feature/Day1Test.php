<?php
use App\Days\Day1;

beforeEach(function (){
    $this->input = '3   4
4   3
2   5
1   3
3   9
3   3';
    $this->day = new Day1(collect(Str::of($this->input)->explode("\n")));
});

test('Part 1', function (){
    $this->assertEquals(11, $this->day->part1());
});

test('Part 2', function (){
    $this->assertEquals(31, $this->day->part2());
});
