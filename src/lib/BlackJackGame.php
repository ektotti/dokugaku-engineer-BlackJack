<?php
require_once('Card.php');
require_once('InitiateGameController.php');
require_once('InitiateTwoPlayerGame.php');
require_once('CalculateWithInvariableA.php');
require_once('CalculateWithVariableA.php');
require_once('UserTurn.php');
require_once('DealerTurn.php');

class BlackJackGame
{
    const TWENTY_ONE = 21;
    protected $deck;
    protected $playerHand;
    protected $dealerHand;

    public function __construct(Deck $deck)
    {
        $this->deck = $deck;
        $this->playerHand = $this->deck->drawTwo();
        $this->dealerHand = $this->deck->drawTwo();
    }

    public function start()
    {
        echo 'ブラックジャックゲームへようこそ。'.PHP_EOL;
        echo 'playerは何名ですか？'.PHP_EOL;
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        $initRule = new InitiateTwoPlayerGame($this->deck);
        $initController = new InitiateGameController($initRule);
        $hands = $initController->drawCard();
        $initController->declareCard($hands);
        // $rule = new CalculateWithVariableA;
        // $userTurn = new UserTurn($this->deck, $this->playerHand, $rule);
        // $userScore = $userTurn->start();
        
        // $dealerTurn = new DealerTurn($this->deck, $this->dealerHand, $rule);
        // $dealerScore = $dealerTurn->start();
        // $this->judgement($userScore, $dealerScore);
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
        echo "ディーラーの得点は{$dealerScore}点です。";
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