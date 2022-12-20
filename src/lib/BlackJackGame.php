<?php
require_once('Card.php');
require_once('InitiateGameController.php');
require_once('InitiateTwoPlayerGame.php');
require_once('InitiateGameWithCpu.php');
require_once('TurnInterface.php');
require_once('TurnWithCpu.php');
require_once('TurnWithoutCpu.php');
require_once('CalculateWithInvariableA.php');
require_once('CalculateWithVariableA.php');
require_once('UserTurn.php');
require_once('DealerTurn.php');
require_once('CpuTurn.php');

class BlackJackGame
{
    const TWENTY_ONE = 21;
    private $deck;
    private $hands;

    public function __construct(Deck $deck)
    {
        $this->deck = $deck;
    }

    public function start()
    {
        echo 'ブラックジャックゲームへようこそ。'.PHP_EOL;
        echo '参加者は何名ですか？(1/2/3/4)'.PHP_EOL;
        $participantNum = fgets(STDIN);
        $participantNum = trim($participantNum);

        if((int) $participantNum === 1) {
            $initRule = new InitiateTwoPlayerGame($this->deck);
        } elseif((int) $participantNum >= 2 && (int) $participantNum <= 4) {
            $initRule = new InitiateGameWithCpu($this->deck, (int) $participantNum);
        }else{
            die('参加人数が不正です');
        }
        $this->initiateGame($initRule);

        if((int) $participantNum === 1) {
            $drawingTurn = new TurnWithoutCpu($this->deck, null, $this->hands);
        } elseif((int) $participantNum >= 2 && (int) $participantNum <= 4) {
            $drawingTurn = new TurnWithCpu($this->deck, null, $this->hands);
        }else{
            die('参加人数が不正です');
        }
        $scores = $this->runDrawingTurn($drawingTurn);

        $this->judgement($scores);

        echo 'ブラックジャックを終了します。'.PHP_EOL;
    }

    private function initiateGame(InitiateInterface $initRule)
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        $this->hands = $initRule->drawCard(); 
        $initRule->declareCard($this->hands);
    }

    private function runDrawingTurn(TurnInterface $drawingTurn)
    {
        echo '各プレイヤーがヒットかステイを選択します。';
        return $drawingTurn->startDrawingTurn();
    }

    private function judgement(array $scores)
    {
        $dealerScore = array_pop($scores);

        foreach ($scores as $playerName => $score) {
            if($score > self::TWENTY_ONE) {
                echo "{$playerName}はバーストです。負けました。".PHP_EOL;
                continue;
            }
            
            if($dealerScore > self::TWENTY_ONE) {
                echo "ディーラーはバーストです。{$playerName}は勝ちました。".PHP_EOL;
                continue;
            }
            
            if(self::TWENTY_ONE - $score < self::TWENTY_ONE - $dealerScore) {
                echo "{$playerName}は勝ちました。".PHP_EOL;
                continue;
            }
            
            if(self::TWENTY_ONE - $score > self::TWENTY_ONE - $dealerScore) {
                echo "{$playerName}は負けました。".PHP_EOL;
                continue;
            }

            echo '引き分けです。'.PHP_EOL;
        }
    }
}