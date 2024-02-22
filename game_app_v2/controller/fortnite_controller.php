<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the fortnite controller file. 
   -->
   <?php
require_once "../model/fortnite_db.php";
require_once "fortnite.php";

class FortniteController {
    
    //helper function to convert a db row into a
    //User object
    Private static function rowToReview($row) {
        $fortnite = new Fortnite(
            $row['EMail'],
            $row['Rating'],
            $row['Review'],
            $row['ReviewPostDate']);
            $fortnite->setReviewId($row['ReviewId']);
        return $fortnite;
    }

    //function to get all reviews in the database
    public static function getAllReviews() {
        $queryRes = FortniteDB::getReviews();

        if ($queryRes) {
            //process the results into an array with
            //the GameNo and the GameName - allows the
            //UI to not care about the DB structure
            $fortnite = array();
            foreach ($queryRes as $row) {
                //process each row into an array of
                //Review objects (i.e. "review")
                $fortnites[] = self::rowToReview($row);
            }

            return $fortnites;
        } else {
            return false;
        }
    }

    //function to get review in a specific game
    public static function getReviewsByGame($gameId) {
        $queryRes = FortniteDB::getReviews($gameId);

        if ($queryRes) {
            $fortnites = array();
            foreach ($queryRes as $row) {
                $fortnites[] = self::rowToReview($row);
            }

            return $fortnites;
        } else {
            return false;
        }
     }

    //function to get a specific review by their PersonNo
   public static function getReviewById($reviewId) {
        $queryRes = FortniteDB::getReview($reviewId);

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
        return FortniteDB::deleteReview($reviewId);
    }

    //function to add a review to the DB
    public static function addReview($review) {
        return FortniteDB::addReview(
            $review->getEMail(),
            $review->getRating(),
            $review->getReview(),
            $review->getReviewPostDate());
    }

    //function to update a reviewer's information
    public static function updateReview($review) {
        return FortniteDB::updateReview(
            $review->getReviewId(),
            $review->getEMail(),
            $review->getRating(),
            $review->getReview(),
            $review->getReviewPostDate());
    }
}