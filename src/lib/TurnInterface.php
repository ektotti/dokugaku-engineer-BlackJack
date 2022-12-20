<?php

interface TurnInterface
{
    public function __construct(Deck $deck, UserStateInterface $userState = null, array $hands);
    public function startDrawingTurn(): array;
}