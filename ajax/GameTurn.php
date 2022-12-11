<?php
include_once('../class/ToolKit.php');
include_once '../class/Game.php';

$game_data = $_POST['game'];


$game = new Game();
$game->copyJSON($game_data);

echo json_encode($game->turnResult());