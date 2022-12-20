<?php

abstract class Turn
{
    protected $deck;
    protected $hand;
    protected $rule;
    public function __construct(Deck $deck, array $hand, CalculateRuleInterface $rule)
    {
        $this->deck = $deck;
        $this->hand = $hand;
        $this->rule = $rule;
    }
    abstract public function start($name = null);
}