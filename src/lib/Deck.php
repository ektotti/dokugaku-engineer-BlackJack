<?php
require_once('Card.php');

class Deck
{
    
    private $cards;
    public function __construct()
    {
        foreach (Card::CARD_PATTERN as $initial => $name) {
            foreach(Card::CARD_NUMBER as $number) {
                $this->cards[] = new Card($initial . $number);
            }
        }

    }
    public function getDeck()
    {
        return $this->cards;
    }
    public function drawTwo()
    {
        $drawedCard = [];
        shuffle($this->cards);
        $drawedCard[] = array_shift($this->cards);
        $drawedCard[] = array_shift($this->cards);
        return $drawedCard;
    }
    public function drawOne()
    {
        shuffle($this->cards);
        return array_shift($this->cards);
    }

}