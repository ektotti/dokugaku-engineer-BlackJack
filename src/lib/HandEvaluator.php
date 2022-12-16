<?php

require_once('CalculateRuleInterface.php');

class HandEvaluator
{
    private $rule;
    public function __construct(CalculateRuleInterface $rule)
    {
        $this->rule = $rule;
    }

    public function getScore($hand)
    {
        return $this->rule->getScore($hand);
    }
}