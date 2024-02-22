<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the game controller file. 
   -->
<?php
include_once('game.php');
include_once('../model/game_db.php');

class GameController {
    public static function getAllGames() {
        $queryRes = GameDB::geGames();

        if ($queryRes) {
            //process the results into an array of 
            //Role objects
            $games = array();
            foreach ($queryRes as $row) {
                $games[] = new Game($row['GameNo'],
                    $row['GameName']);
            }

            //return the array of Role information
            return $games;
        } else {
            return false;
        }
    }
}