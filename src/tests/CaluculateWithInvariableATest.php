<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../lib/Card.php';
require_once __DIR__ . '/../lib/CaluculateWithInvariableA.php';

class CaluculateWithInvariableATest extends TestCase
{
    public function testGetScore(): void
    {
        $cardA = new Card('S10');
        $cardB = new Card('D2');
        $cardC = new Card('SK');
        $cardD = new Card('DA');
        $rule = new CaluculateWithInvariableA;
        $this->assertSame(12, $rule->getScore([$cardA, $cardB]));
        $this->assertSame(11, $rule->getScore([$cardC, $cardD]));
    }
}
