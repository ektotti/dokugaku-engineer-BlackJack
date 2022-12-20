<?php

require_once('TurnInterface.php');

class TurnWithoutCpu implements TurnInterface
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
        // ここでインスタンス化するべきか？要検討。
        $calculateRule = new CalculateWithVariableA;
        $userTurn = new UserTurn($this->deck, $this->hands[0], $calculateRule);
        $userScore = $userTurn->start();

        $dealerTurn = new DealerTurn($this->deck, $this->hands[1], $calculateRule);
        $dealerScore = $dealerTurn->start();
        return [$userScore, $dealerScore];
    }
}