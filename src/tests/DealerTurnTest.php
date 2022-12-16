<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../lib/DealerTurn.php';
require_once __DIR__ . '/../lib/Card.php';
require_once __DIR__ . '/../lib/CalculateWithVariableA.php';

class DealerTurnTest extends TestCase
{
    public function testDealerTurn(): void
    {
        $deck = new Deck;
        $cardsA = [new Card('SJ'), new Card('D8')];
        $rule = new CalculateWithVariableA;
        $dealerTurn = new DealerTurn($deck, $cardsA, $rule);
        $this->assertGreaterThanOrEqual(17, $dealerTurn->start());
    }
}