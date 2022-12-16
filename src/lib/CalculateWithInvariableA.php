<?php

require_once('CalculateRuleInterface.php');

class CalculateWithInvariableA implements CalculateRuleInterface
{
    /**
     * @param Card[] $hand
     */
    public function getScore(array $hand): int
    {
        $score = 0;
        foreach($hand as $card) {
            $score += $card->getRank();
        }
        return $score; 
    }
}