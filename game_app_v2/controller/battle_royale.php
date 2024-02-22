<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the battle_royale objects file. 
   -->
<?php
//Review class to represent a single entry in the Reviews table
class Battle_Royale {
    //class properties - match the colums in the Reviews table
    //with one exception  - the DB stroes EMail, so we'll
    //just store a users class object.
    private $reviewId;
    private $eMail;
    private $rating;
    private $review;
    private $reviewPostDate;

    public function __construct($eMail, $rating, $review, $reviewPostDate)
    {
        $this->eMail = $eMail;
        $this->rating = $rating;
        $this->review = $review;
        $this->reviewPostDate = $reviewPostDate;
    }
    //get and set the review properties
    public function getReviewId() {
        return $this->reviewId;
    }
    public function setReviewId($value) {
        $this->reviewId = $value;
    }

    //get and set EMail property
    public function getEMail() {
        return $this->eMail;
    }
    public function setEMail($value) {
        $this->eMail = $value;
    }

    public function getRating() {
        return $this->rating;
    }
    public function setRating($value) {
        $this->rating = $value;
    }
    public function getReview() {
        return $this->review;
    }
    public function setReview($value) {
        $this->review = $value;
    }
    public function getReviewPostDate() {
        return $this->reviewPostDate;
    }
    public function setReviewPostDate($value) {
        $this->reviewPostDate = $value;
    }

}