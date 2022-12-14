<?php

class Game
{
    public $appRole;
    private $toolkit;
    public $nbPlayer;
    public $players;
    public $actions;
    public $cards;
    public $pointLimit;
    private $role_name;
    public $nbSnitch;


    public function __construct()
    {
        $this->toolkit = new ToolKit();
        // $this->init($nbPlayer);
    }

    function init(int $nbPlayer)
    {
        $this->verifyNbPlayer($nbPlayer);
        $json = $this->toolkit->getJon('../assets/data/rules.json');
        $this->appRole = $json['app_role'];
        $this->actions = $json['actions'];
        $this->cards = $json['cards'];
        $this->role_name = $json['role'];
        $this->defineSnitchNb($json['nb_snitch']);
        $this->getSetPseudoAndRole($json['pseudo']);
        $this->setPointLimit($json['score']);
    }

    //recopie des data d'un json pour recréer l'objet selon certaines data
    public function copyJSON(array $data)
    {
        $this->verifyNbPlayer($data["nbPlayer"]);
        $this->appRole = $data["appRole"];
        $this->actions = $data["actions"];
        $this->cards = $data["cards"];
        $this->nbSnitch = $data["nbSnitch"];
        $this->players = $data["players"];
        $this->pointLimit = $data["pointLimit"];
    }
    
    private function setPointLimit(array $rules_score)
    {
        $nb = $this->getNbPlayer();
        switch ($nb) {
            case 4:
                $this->pointLimit = $rules_score['4'];
                break;
            case 5:
                $this->pointLimit = $rules_score['5'];
                break;
            case 6:
                $this->pointLimit = $rules_score['6'];
                break;
            case 7:
                $this->pointLimit = $rules_score['7'];
                break;
            case 8:
                $this->pointLimit = $rules_score['8'];
                break;
            default:
                //TODO ajust the return error message
                throw new Exception('Le nombre de joueur doit être compris entre 4 et 10');
        }
    }
    private function verifyNbPlayer(int $nbPlayer)
    {
        if ($nbPlayer < 4 || $nbPlayer > 8) {
            //TODO ajust the return error message
            throw new Exception('Le nombre de joueur doit être compris entre 4 et 10');
        }
        $this->nbPlayer = $nbPlayer;
    }
    public function getNbPlayer()
    {
        return $this->nbPlayer;
    }

    public function getSetPseudoAndRole(array $arrayPseudo)
    {
        $pseudo_list = [];
        $index[] = [];
        $index_impo[] = [];
        for($i = 0; $i < $this->nbPlayer; $i++) {
            $index[$i] = $i;
        }
        
        for ($j = 0; $j < $this->nbSnitch; $j++){
            $pos = rand(0, $this->nbPlayer);
            $index_impo[$j] = $index[$pos];
        }
        
        for ($i = 0; $i < $this->nbPlayer; $i++) {
            $pseudo = array_shift($arrayPseudo);
            $role = in_array($i, $index_impo) ? $this->role_name['snitch'] : $this->role_name['player'];
            $pseudo_list[] = [
                "PSEUDO" => $pseudo,
                "ROLE" => $role
            ];
            $this->players = $pseudo_list;
        }
    }

    public function getAction()
    {
        $action = $this->toolkit->randomArraySelector($this->actions);
        switch($action){
            case "pick_1_card":
            case "switch_1_card":
            case "switch_deck":
            case "ask_for_the_snitch":
                $player = $this->toolkit->randomSelector($this->players);
                return $player['PSEUDO'] . ' ' . $this->actions[$action];
            default:
                return $this->actions[$action];
        }
    }
    public function getCards()
    {
        return $this->toolkit->randomSelector($this->cards);
    }

    private function defineSnitchNb(array $snitches)
    {
        $nb = $this->getNbPlayer();
        switch ($nb) {
            case 4:
                $this->nbSnitch = $snitches['4'];
                break;
            case 5:
                $this->nbSnitch = $snitches['5'];
                break;
            case 6:
                $this->nbSnitch = $snitches['6'];
                break;
            case 7:
                $this->nbSnitch = $snitches['7'];
                break;
            case 8:
                $this->nbSnitch = $snitches['8'];
                break;
            default:
                //TODO ajust the return error message
                throw new Exception('Le nombre de joueur doit être compris entre 4 et 10');
        }
    }

    private function playerSelected(){
        $c = ceil($this->getNbPlayer() / 2);

        $selected = $this->toolkit->randomUniqueSelector($this->players, $c);
        return $selected;

    }
    public function startGame(int $nbTurn)
    {
        //TODO start the game
        // function to return pseudo and role
        switch($nbTurn){
            case '1':
                $this->firstTurnOfGame();
                break;
            case '2':
                $this->turnOfGame();
                break;
            case '3':
                $this->turnOfGame();
                break;
            case '4':
                $this->turnOfGame();
                break;
            case '5':
                $this->turnOfGame();
                echo "Fin de la partie";
                break;
            default: 
                echo "GAME OVER";
                break;
        }

    }

    private function firstTurnOfGame(){
        echo "\n";
        echo "Personne suspectée : \n";
        $selected = $this->playerSelected();
        foreach($selected as $player){
            echo $player['PSEUDO'] ."\n";
        }
        echo "Object rechercher " . $this->getCards();
        echo "\n";
        $checked = $this->selectedPersonToBeCheck($selected);
        echo "Personne à vérifier : \n";
        foreach($checked as $player){
            echo $player['PSEUDO'] ."\n";
        }
        
    }
    private function turnOfGame(){
        echo " \n";
        echo $this->getAction();
       $this->firstTurnOfGame();
    }

    private function selectedPersonToBeCheck(array $selected){
        $nbCheck = count($selected);
        $check = $this->toolkit->algoRand(0, $nbCheck);
        $toCheck = [];
        for($i = 0; $i < $nbCheck; $i++){
            if(!in_array($selected[array_rand($selected)], $toCheck)){
                $toCheck[] = $selected[array_rand($selected)];
            }
        }
        return $toCheck;
    }
    public function turnResult(){
        $selected = $this->playerSelected();
        $result = [
            "selected" => $selected,
            "inspected" => $this->selectedPersonToBeCheck($selected),
            "action" => $this->getAction(),
            "cards" => $this->getCards()
        ];
        return $result;
    }
}