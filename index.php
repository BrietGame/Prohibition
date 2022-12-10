<?php
include_once './class/Game.php';

$game = new Game(6);

echo $game->getNbPlayer();
// var_dump($game->appRole);
// var_dump($game->playerName);
// var_dump($game->getAction());
// var_dump($game->pointLimit);
// var_dump($game->getCards());
// var_dump($game->nbSnitch);