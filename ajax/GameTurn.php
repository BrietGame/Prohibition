<?php
include_once('../class/ToolKit.php');
include_once '../class/Game.php';

$game_data = (object) $_POST['game'];
var_dump($game_data);

$game = new Game();
$game->init($game_data->nbPlayer);
var_dump($game);
die();
$game = $game->startGame(5);

$turn = $game;

echo json_encode([
    "turn" => $turn
]);
