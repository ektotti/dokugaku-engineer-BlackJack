<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../lib/Card.php';
require_once __DIR__ . '/../lib/CalculateWithVariableA.php';

class CalculateWithVariableATest extends TestCase
{
    public function testGetScore(): void
    {
        $cardsA = [new Card('S10'), new Card('D2')];
        // Aが11になるパターン。
        $cardsB = [new Card('S2'), new Card('DA')];
        // Aが1になるパターン。
        $cardsC = [new Card('SK'), new Card('DA'), new Card('D10')];
        $cardsD = [new Card('SK'), new Card('DA'), new Card('CA')];
        $rule = new CalculateWithVariableA;
        $this->assertSame(12, $rule->getScore($cardsA));
        $this->assertSame(13, $rule->getScore($cardsB));
        $this->assertSame(21, $rule->getScore($cardsC));
        $this->assertSame(22, $rule->getScore($cardsD));
    }
}
