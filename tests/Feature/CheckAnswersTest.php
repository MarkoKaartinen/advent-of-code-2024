<?php
use App\Days\Day1;
use App\Days\Day2;

test('Day 1', function () {
    $this->assertEquals(1258579, (new Day1)->part1());
    $this->assertEquals(23981443, (new Day1)->part2());
});

test('Day 2', function () {
    $this->assertEquals(663, (new Day2)->part1());
    $this->assertEquals(692, (new Day2)->part2());
});
