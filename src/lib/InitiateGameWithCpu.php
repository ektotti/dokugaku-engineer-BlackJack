<?php

require_once('InitiateInterface.php');

class InitiateGameWithCpu implements InitiateInterface
{
    const PLAYER_NAME = ['あなた', 'ディーラー'];
    private $deck;
    private $totalParticipantNum;
    private $cpuParticipantNum;
    private $playerName;
    public function __construct(Deck $deck, int $participantNum = 1)
    {
        $this->deck = $deck;
        $this->totalParticipantNum = $participantNum + 1;
        $this->cpuParticipantNum = $participantNum - 1;
        
        $this->playerName =['あなた'];
        for ($i=1; $i <= $this->cpuParticipantNum; $i++) { 
            $this->playerName[] = "CPU{$i}";
        }
        $this->playerName[] = 'ディーラー';
    }

    public function drawCard(): array
    {
        $hands = [];
        foreach ($this->playerName as $value) {
            $hands[$value] = $this->deck->drawTwo();
        }
        return $hands;
    }

    public function declareCard($initiatedHands): void
    {
        foreach ($initiatedHands as $player => $initiatedHand) {
            foreach ($initiatedHand as $key => $card) {
                if ($player === "ディーラー" && $key === 1) {
                    echo "ディーラーの引いた2枚目のカードはわかりません。" . PHP_EOL;
                    continue;
                }
                echo "{$player}の引いたカードは{$card->declareCard()}です。" . PHP_EOL;
            }
        }
    }
}
