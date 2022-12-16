<?php

require_once('CalculateRuleInterface.php');

class CalculateWithVariableA implements CalculateRuleInterface
{
    /**
     * @param Card[] $hand
     */
    public function getScore(array $hand): int
    {
        $score = 0;
        $countAce = 0;
        foreach($hand as $card) {
            if($card->getRank() === 1) {
                $countAce++;
            } else {
                $score += $card->getRank();
            }
        }

        for ($i=0; $i < $countAce; $i++) { 
            if($score + Card::MAX_ACE_RANK <= 21) {
                $score += Card::MAX_ACE_RANK;
            } else {
                $score += Card::MIN_ACE_RANK;
            }
        }

        return $score; 
    }
}