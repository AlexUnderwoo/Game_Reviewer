<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the game objects file. 
 
   -->
<?php
//Role class to represent a single entry in the
//Role table
class Game {
    //class properties = match the columns in the
    //Roles table; control access via get/set
    //methodes and the constructor
    private $gameNo;
    private $gameName;

    public function __construct($gameNo, $gameName) {
        $this->gameNo = $gameNo;
        $this->gameName = $gameName;
    }

    //get and set the roleNo property
    public function getGameNo() {
        return $this->gameNo;
    }
    public function setGameNo($value) {
        $this->gameNo = $value;
    }

    //get and set roleName property
    public function getGameName() {
        return $this->gameName;
        
    }
    public function setGameName($value) {
        $this->gameName = $value;
    }
}