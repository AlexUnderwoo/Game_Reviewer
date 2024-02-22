<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the update add delete Controller file for review tables of Fortnote
    , && Halo. This file requires controller/review_controller.php and controller
    /game_controller.php. All data in table Fortnite && Halo are added, updated, or 
    deleted using the if statements and Review Controller. A title,
    heading an and form is added to displat a web page to display the updated
    data collected in the battle royale database table using the POST method. 
   -->
<?php
    require_once('../controller/review.php');
    require_once('../controller/review_controller.php');
    require_once('../controller/game.php');
    require_once('../controller/game_controller.php');


    $reviews = ReviewController::getAllReviews();

    //default review for add - empty strings and first role
    //in list
    $review = new Review('', '', '', date('Y-m-d')); 
    $review->setReviewId(-1);
    $pageTitle = "Add a New Review";

    //Retrieve the reviewNo from the query string and
    //and use it to create a review object for that pNo
     if (isset($_GET['pNo'])) {
        $review =
            ReviewController::getReviewById($_GET['pNo']);
        $pageTitle = "Update an Existing Review";
    }
 
    if (isset($_POST['save'])) {
        //save button - perform add or update
        //gameOptions are 1, 2, 3...the $games array is base
        //0 index, so subtract 1 from the selected option to
        //get the correct index
        $review = new Review($_POST['eMail'], $_POST['rating'],
                            $_POST['review'],$_POST['start'], 
                            $games[$_POST['gameOption']-1]);
        $review->setReviewId($_POST['pNo']);

        if ($review->getReviewId() === '-1') {
            //add
            ReviewController::addReview($review);
        } else {
            //update
            ReviewController::updateReview($review);
        }

        //return to people list
        header('Location: ./display_review.php');
    }

    if (isset($_POST['cancel'])) {
        //cancel button - just go back to list
        header('Location: ./display_review.php');
    }
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="icon" href="../admin_view/images/gri.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Welcome to our game reviews</title>
</head>

<body>
<div class="background-image"></div>
    <h1>Welcome to out game reviews</h1>
    <h2><?php echo $pageTitle; ?></h2>
    <form method='POST'>
        <h3>EMail: <input type="text" name="eMail"
            value="<?php echo $review->getEMail(); ?>">
        </h3>
        <h3>Rating: <input type="int" name="rating"
            value="<?php echo $review->getRating(); ?>">
        </h3>
        <h3>Review: <input type="text" name="review"
            value="<?php echo $review->getReview(); ?>">
        </h3>
        <h3>Review Post Date: <input type="date" name="start"
            value="<?php echo $review->getReviewPostDate(); ?>">
        </h3>
       
        </h3>
        <input type="hidden"
            value="<?php echo $review->getReviewId(); ?>" name="pNo">
        <input type="submit" value="Save" name="save">
        <input type="submit" value="Cancel" name="cancel">
    </form>
</body>
</html>