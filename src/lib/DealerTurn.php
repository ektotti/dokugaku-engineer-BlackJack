<?php

require_once('Turn.php');
require_once('HandEvaluator.php');
class DealerTurn extends Turn
{
    public function start()
    {
        $handEvaluator = new HandEvaluator($this->rule);
        $score = $handEvaluator->getScore($this->hand);

        echo "ディーラーの引いた2枚目のカードは{$this->hand[1]->declareCard()}でした。" . PHP_EOL;
        echo "ディーラーの得点は{$score}点です。" . PHP_EOL;
        
        while ($score <= 17) {
            $drawnCard = $this->deck->drawOne();
            echo "ディーラーの引いたカードは{$drawnCard->declareCard()}です。" . PHP_EOL;
            $this->hand[] = $drawnCard;
            $score = $handEvaluator->getScore($this->hand);
        }

        return $score;
    }
}
