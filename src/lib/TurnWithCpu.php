<?php

require_once('TurnInterface.php');

class TurnWithCpu implements TurnInterface
{
    private $deck;
    private $userState;
    private $hands;
    public function __construct(Deck $deck, UserStateInterface $userState = null, array $hands)
    {
        $this->deck = $deck;
        $this->userState = $userState;
        $this->hands = $hands;
    }

    public function startDrawingTurn(): array
    {
        $userHand = array_shift($this->hands);
        $dealerHand = array_pop($this->hands);
        $cpuHands = $this->hands;
        // ここでインスタンス化するべきか？要検討。
        $calculateRule = new CalculateWithVariableA;
        $userTurn = new UserTurn($this->deck, $userHand, $calculateRule);
        $score = [];
        $score['あなた'] = $userTurn->start();
        
        foreach($cpuHands as $key => $cpuHand){
            $cpuTurn = new CpuTurn($this->deck, $cpuHand, $calculateRule);
            $score[$key] = $cpuTurn->start($key);
        }

        $dealerTurn = new DealerTurn($this->deck, $dealerHand, $calculateRule);
        $score['ディーラー'] = $dealerTurn->start();
        return $score;
    }
}