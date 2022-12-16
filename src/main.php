<?php

require_once('lib/DECK.PHP');
require_once('lib/BlackJackGame.php');

$deck = new Deck;
$game = new BlackJackGame($deck);
$game->start();