<?php
use App\Days\Day2;

beforeEach(function (){
    $this->input = '7 6 4 2 1
1 2 7 8 9
9 7 6 2 1
1 3 2 4 5
8 6 4 4 1
1 3 6 7 9';
    $this->day = new Day2(collect(Str::of($this->input)->explode("\n")));
});

test('Part 1', function (){
    $this->assertEquals(2, $this->day->part1());
});

test('Part 2', function (){
    $this->assertEquals(4, $this->day->part2());
});
