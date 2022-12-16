<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../lib/Card.php';
require_once __DIR__ . '/../lib/CalculateWithInvariableA.php';

class CalculateWithInvariableATest extends TestCase
{
    public function testGetScore(): void
    {
        $cardA = new Card('S10');
        $cardB = new Card('D2');
        $cardC = new Card('SK');
        $cardD = new Card('DA');
        $rule = new CalculateWithInvariableA;
        $this->assertSame(12, $rule->getScore([$cardA, $cardB]));
        $this->assertSame(11, $rule->getScore([$cardC, $cardD]));
    }
}
