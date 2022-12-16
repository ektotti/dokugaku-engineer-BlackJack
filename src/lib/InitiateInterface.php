<?php

interface InitiateInterface
{
    public function __construct(Deck $deck);

    public function drawCard(): array;
    public function declareCard($initiatedHands): void;
}