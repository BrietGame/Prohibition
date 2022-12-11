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
// $nbPerson;
// if (!empty($_POST['nbPlayer'])) {
//     $nbPerson = $_POST['nbPlayer'];
//     $game = new Game($nbPerson);
//     echo "<pre>";
//     print_r($game);
//     echo "</pre>";
//     die();
// }



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
        <form action="" method="post">
            <input type="radio" name="nbPlayer" id="nbPlayer" value="4">
            <label for="nbPlayer">4</label>
            <input type="radio" name="nbPlayer" id="nbPlayer" value="5">
            <label for="nbPlayer">5</label>
            <input type="radio" name="nbPlayer" id="nbPlayer" value="6">
            <label for="nbPlayer">6</label>
            <input type="radio" name="nbPlayer" id="nbPlayer" value="7">
            <label for="nbPlayer">7</label>
            <input type="radio" name="nbPlayer" id="nbPlayer" value="8">
            <label for="nbPlayer">8</label>
            <input type="submit" id="submit" value="Valider">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>