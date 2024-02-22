<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the update add delete Controller file for Fortnite.
    This file requires controller/fortnite_controller.php and controller
    /game_controller.php. All data in table fortnite is added, updated, or 
    deleted using the if statements and Fortnite Controller. A title,
    heading an and form is added to displat a web page to display the updated
    data collected in the fortnite database table using the POST method. 

   -->
   <?php
    require_once('../controller/fortnite.php');
    require_once('../controller/fortnite_controller.php');
    require_once('../controller/game.php');
    require_once('../controller/game_controller.php');


    $fortnites = FortniteController::getAllReviews();

    //default review for add - empty strings and first role
    //in list
    $fortnite = new Fortnite('', '', '', date('Y-m-d'));
    $fortnite->setReviewId(-1);
    $pageTitle = "Add Review";

    //Retrieve the reviewNo from the query string and
    //and use it to create a review object for that pNo
     if (isset($_GET['pNo'])) {
        $fortnite =
        FortniteController::getReviewById($_GET['pNo']);
        $pageTitle = "Update an Existing Review";
    }
 
    if (isset($_POST['save'])) {
        //save button - perform add or update
        //gameOptions are 1, 2, 3...the $games array is base
        //0 index, so subtract 1 from the selected option to
        //get the correct index
        $fortnite = new Fortnite($_POST['eMail'], $_POST['rating'],
                            $_POST['review'],$_POST['start'],
                            $games[$_POST['gameOption']-1]);
        $fortnite->setReviewId($_POST['pNo']);

        if ($fortnite->getReviewId() === '-1') {
            //add
            FortniteController::addReview($fortnite);
        } else {
            //update
            FortniteController::updateReview($fortnite);
        }

        //return to review list
        header('Location: ./display_fortnite.php');
    }

    if (isset($_POST['cancel'])) {
        //cancel button - just go back to list
        header('Location: ./display_fortnite.php');
    }
?>
<html>
<head>
<link rel="icon" href="../admin_view/images/gri.png" type="image/png">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Welcome to our Fortnite Game Reviews</title>
</head>

<body>
<div class="background-image"></div>
    <h1>Welcome to our Fortnite Game Reviews</h1>
    <h2><?php echo $pageTitle; ?></h2>
    <form method='POST'>
        <h3>EMail: <input type="text" name="eMail"
            value="<?php echo $fortnite->getEMail(); ?>">
        </h3>
        <h3>Rating: <input type="int" name="rating"
            value="<?php echo $fortnite->getRating(); ?>">
        </h3>
        <h3>Review: <input type="text" name="review"
            value="<?php echo $fortnite->getReview(); ?>">
        </h3>
        <h3>Review Post Date: <input type="date" name="start"
            value="<?php echo $fortnite->getReviewPostDate(); ?>">
        </h3>
       
        </h3>
        <input type="hidden"
            value="<?php echo $fortnite->getReviewId(); ?>" name="pNo">
        <input type="submit" value="Save" name="save">
        <input type="submit" value="Cancel" name="cancel">
    </form>
</body>
</html>