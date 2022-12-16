<?php

require_once('Turn.php');
require_once('HandEvaluator.php');

class UserTurn extends Turn
{
    public function start()
    {
        $handEvaluator = new HandEvaluator($this->rule);
        $answer = 'Y';
        while (trim($answer) === 'Y') {
            $score = $handEvaluator->getScore($this->hand);
            echo "あなたの現在の得点は{$score}点です。カードを引きますか？(Y/N)". PHP_EOL;
            $answer = (string) fgets(STDIN);
            $answer = trim($answer);
            if ($answer === 'Y') {
                $drawnCard = $this->deck->drawOne();
                echo "あなたの引いたカードは{$drawnCard->getPattern()}の{$drawnCard->getNumber()}です。" . PHP_EOL;
                $this->hand[] = $drawnCard;
                $score = $handEvaluator->getScore($this->hand);
                if($score > BlackJackGame::TWENTY_ONE) {
                    BlackJackGame::overTwentyOne($score);
                }
            }
        }
        return $score;
    }
}
