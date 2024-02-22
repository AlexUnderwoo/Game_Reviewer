<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the battle_royale controller file. 
   -->
<?php
require_once "../model/battle_royale_db.php";
require_once "battle_royale.php";

class Battle_RoyaleController {
    
    //helper function to convert a db row into a
    //User object
    Private static function rowToReview($row) {
        $battle_royale = new Battle_Royale(
            $row['EMail'],
            $row['Rating'],
            $row['Review'],
            $row['ReviewPostDate']);
            $battle_royale->setReviewId($row['ReviewId']);
        return $battle_royale;
    }

    //function to get all reviews in the database
    public static function getAllReviews() {
        $queryRes = Battle_RoyaleDB::getReviews();

        if ($queryRes) {
            //process the results into an array with
            //the GameNo and the GameName - allows the
            //UI to not care about the DB structure
            $battle_royales = array();
            foreach ($queryRes as $row) {
                //process each row into an array of
                //Review objects (i.e. "review")
                $battle_royales[] = self::rowToReview($row);
            }

            return $battle_royales;
        } else {
            return false;
        }
    }

    //function to get review in a specific game
    public static function getReviewsByGame($gameId) {
        $queryRes = Battle_RoyaleDB::getReviews($gameId);

        if ($queryRes) {
            $battle_royales = array();
            foreach ($queryRes as $row) {
                $battle_royales[] = self::rowToReview($row);
            }

            return $battle_royales;
        } else {
            return false;
        }
     }

    //function to get a specific review by their PersonNo
   public static function getReviewById($reviewId) {
        $queryRes = Battle_RoyaleDB::getReview($reviewId);

        if ($queryRes) {
            //this query only returns a single row, so
            //just process it
            return self::rowToReview($queryRes);
        } else {
            return false;
        }
    }
   
    //function to delete a review by their PersonNo
    public static function deleteReview($reviewId) {
        //no special processing needed - just use the
        //DB function
        return Battle_RoyaleDB::deleteReview($reviewId);
    }

    //function to add a review to the DB
    public static function addReview($review) {
        return Battle_RoyaleDB::addReview(
            $review->getEMail(),
            $review->getRating(),
            $review->getReview(),
            $review->getReviewPostDate());
    }

    //function to update a reviewer's information
    public static function updateReview($review) {
        return Battle_RoyaleDB::updateReview(
            $review->getReviewId(),
            $review->getEMail(),
            $review->getRating(),
            $review->getReview(),
            $review->getReviewPostDate());
    }
}