<?php

require_once('Turn.php');
require_once('HandEvaluator.php');
class CpuTurn extends Turn
{
    public function start($name = null)
    {
        $handEvaluator = new HandEvaluator($this->rule);
        $score = $handEvaluator->getScore($this->hand);

        echo "{$name}の得点は{$score}点です。" . PHP_EOL;
        
        while ($score <= 17) {
            $drawnCard = $this->deck->drawOne();
            echo "{$name}の引いたカードは{$drawnCard->declareCard()}です。" . PHP_EOL;
            $this->hand[] = $drawnCard;
            $score = $handEvaluator->getScore($this->hand);
        }

        return $score;
    }
}