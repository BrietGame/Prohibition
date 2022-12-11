<?php
include_once('../class/ToolKit.php');
include_once '../class/Game.php';

// recupere le nombre de joueur
$nbPlayer = intval($_POST['nbPlayer']);

//recupere le joueur actuel
$actual_player = intval($_POST['actualPlayer']);

//recupere la game
$game = $_POST['game'];


// instancie la classe Game
if (empty($game)) {
    $game = new Game();
    $game->init($nbPlayer);

}

//if actualplayer == nbplayer
if ($actual_player == $nbPlayer) {
    echo json_encode([
        "game" => $game,
        "gamestart" => 1
    ]);
    die();
}

echo json_encode([
    "game" => $game,
    "actualplayer" => $actual_player,
    "gamestart" => 0
]);
