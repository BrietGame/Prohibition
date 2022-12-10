<?php
include_once './class/Game.php';

// $game = new Game(6);

// echo $game->getNbPlayer();
// var_dump($game->appRole);
// var_dump($game->playerName);
// var_dump($game->getAction());
// var_dump($game->pointLimit);
// var_dump($game->getCards());
// var_dump($game->nbSnitch);
if(!empty($_POST['nbPlayer'])){
    $nbPerson = $_POST['nbPlayer'];
    $game = new Game($nbPerson);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <div id="playboard">
        <form action="" id="nbPlayer" method="POST">
            <label for="nbPlayer">Nombre de joueur</label>
            <input type="number" name="nbPlayer" min="4" max="8">
            <input type="submit" value="Accepter">
        </form>
    </div>
<script src="./assets/js/main.js"></script>
</body>
</html>