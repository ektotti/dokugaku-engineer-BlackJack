<?php

interface CalculateRuleInterface
{
    /**
     * @param Card[] $hand
     */
    public function getScore(array $hand): int;
}