<?php

class InitiateGameController
{
    public function __construct(private InitiateInterface $init)
    {
        
    }
    public function drawCard(){
        return $this->init->drawCard();
    }

    public function declareCard($hands){
        return $this->init->declareCard($hands);
    }
} 