<?php
use App\Days\Day1;

test('Day 1', function () {
    $this->assertEquals(1258579, (new Day1)->part1());
    $this->assertEquals(23981443, (new Day1)->part2());
});
