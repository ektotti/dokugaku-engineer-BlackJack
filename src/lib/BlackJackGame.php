<?php
require_once('Card.php');
require_once('CalculateWithInvariableA.php');
require_once('UserTurn.php');
require_once('DealerTurn.php');

class BlackJackGame
{
    const TWENTY_ONE = 21;
    private $deck;
    private $playerHand;
    private $dealerHand;

    public function __construct(Deck $deck)
    {
        $this->deck = $deck;
        $this->playerHand = $this->deck->drawTwo();
        $this->dealerHand = $this->deck->drawTwo();
    }

    public function start()
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        echo "あなたの引いたカードは{$this->playerHand[0]->declareCard()}です。" . PHP_EOL;
        echo "あなたの引いたカードは{$this->playerHand[1]->declareCard()}です。" . PHP_EOL;
        echo "ディーラーの引いたカードは{$this->dealerHand[0]->declareCard()}です。" . PHP_EOL;
        echo "ディーラーの引いた2枚目のカードはわかりません。" . PHP_EOL;
        $rule = new CalculateWithInvariableA;
        $userTurn = new UserTurn($this->deck, $this->playerHand, $rule);
        $userScore = $userTurn->start();
        
        $dealerTurn = new DealerTurn($this->deck, $this->playerHand, $rule);
        $dealerScore = $dealerTurn->start();
        $this->judgement($userScore, $dealerScore);
    }

    static function overTwentyOne($score, $isUser = true){
        $loser = $isUser ? 'あなた' : 'ディーラー' ;
        $winner = $isUser ? 'ディーラー' : 'あなた' ;
        $message = <<<EOM
        {$loser}の得点は{$score}です。
        {$winner}の勝ちです。
        ブラックジャックを終了します。
        EOM;
        die($message);
    }

    private function judgement($userScore, $dealerScore)
    {
        echo "あなたの得点は{$userScore}です。" . PHP_EOL;
        if($dealerScore > self::TWENTY_ONE) {
            $this->overTwentyOne($dealerScore, false);
        }
        echo "ディーラーの得点は{$dealerScore}";
        if($userScore > $dealerScore) {
            echo "あなたの勝ちです！。".PHP_EOL;
        } elseif($userScore < $dealerScore) {
            echo "ディーラーの勝ちです！。".PHP_EOL;
        } else{
            echo "引き分けです。".PHP_EOL;
        }
        echo "ブラックジャックを終了します。".PHP_EOL;
    }
}