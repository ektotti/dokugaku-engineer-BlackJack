<?php

interface InitiateInterface
{
    public function __construct(Deck $deck, int $participantNum = 1);

    public function drawCard(): array;
    public function declareCard($initiatedHands): void;
}