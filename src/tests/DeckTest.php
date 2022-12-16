<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../lib/Deck.php';

class DeckTest extends TestCase
{
    public function testDeck(): void
    {
        $deck = new Deck;
        $this->assertSame(52,count($deck->getDeck()));
        $this->assertSame(2,count($deck->drawTwo()));
        $this->assertSame(50,count($deck->getDeck()));
    }
}
