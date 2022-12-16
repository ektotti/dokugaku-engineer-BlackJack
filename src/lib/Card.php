<?php

class Card
{
    const CARD_PATTERN = ["S" => "スペード", "H" => "ハート", "D" => "ダイヤ", "C" => "クラブ"];
    const CARD_NUMBER = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];
    const CARD_RANK = [
        "2" => 2,
        "3" => 3,
        "4" => 4,
        "5" => 5,
        "6" => 6,
        "7" => 7,
        "8" => 8,
        "9" => 9,
        "10" => 10,
        "J" => 10,
        "Q" => 10,
        "K" => 10,
        "A" => 1,
    ];
    const MIN_ACE_RANK = 1;
    const MAX_ACE_RANK = 11;
    private $card;
    public function __construct($card)
    {
        $this->card = $card;
    }

    public function getRank(): int
    {
        return self::CARD_RANK[substr($this->card, 1)];
    }

    public function getNumber(): string
    {
        return substr($this->card, 1);
    }
    
    public function getPattern(): string
    {
        return self::CARD_PATTERN[$this->card[0]];
    }

    public function declareCard() {
        return "{$this->getPattern()}の{$this->getNumber()}";
    }
}