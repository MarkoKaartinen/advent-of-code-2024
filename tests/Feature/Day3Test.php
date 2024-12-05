<?php
use App\Days\Day3;


test('Part 1', function (){
    $input = 'xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))';
    $day = new Day3($input);
    $this->assertEquals(161, $day->part1());
});

test('Part 2', function (){
    $input = "xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))";
    $day = new Day3($input);
    $this->assertEquals(48, $day->part2());
});
