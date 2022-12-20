<?php

require_once('InitiateInterface.php');

class InitiateTwoPlayerGame implements InitiateInterface
{
    const PARTICIPANT_NUM = 2;
    const PLAYER_NAME = ['あなた', 'ディーラー'];
    public function __construct(private Deck $deck, int $participantNum = 1)
    {
    }

    public function drawCard(): array
    {
        $hands = [];
        for ($i = 0; $i < self::PARTICIPANT_NUM; $i++) {
            $hands[] = $this->deck->drawTwo();
        }
        return $hands;
    }

    public function declareCard($initiatedHands): void
    {
        foreach ($initiatedHands as $player => $initiatedHand) {
            foreach ($initiatedHand as $key => $card) {
                if (self::PLAYER_NAME[$player] === self::PLAYER_NAME[1] && $key === 1) {
                    echo "ディーラーの引いた2枚目のカードはわかりません。" . PHP_EOL;
                    continue;
                }
                echo self::PLAYER_NAME[$player]."の引いたカードは{$card->declareCard()}です。" . PHP_EOL;
            }
        }
    }
}
