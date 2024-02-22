<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the update add delete Controller file for Halo.
    This file requires controller/halo_controller.php and controller
    /game_controller.php. All data in table halo is added, updated, or 
    deleted using the if statements and Halo Controller. A title,
    heading an and form is added to displat a web page to display the updated
    data collected in the halo database table using the POST method. 

   -->
   <?php
    require_once('../controller/halo.php');
    require_once('../controller/halo_controller.php');
    require_once('../controller/game.php');
    require_once('../controller/game_controller.php');


    $halos = HaloController::getAllReviews();

    //default review for add - empty strings and first role
    //in list
    $halo = new Halo('', '', '', date('Y-m-d'));
    $halo->setReviewId(-1);
    $pageTitle = "Add Review";

    //Retrieve the reviewNo from the query string and
    //and use it to create a review object for that pNo
     if (isset($_GET['pNo'])) {
        $halo =
            HaloController::getReviewById($_GET['pNo']);
        $pageTitle = "Update an Existing Review";
    }
 
    if (isset($_POST['save'])) {
        //save button - perform add or update
        //gameOptions are 1, 2, 3...the $games array is base
        //0 index, so subtract 1 from the selected option to
        //get the correct index
        $halo = new Halo($_POST['eMail'], $_POST['rating'],
                            $_POST['review'],$_POST['start'],
                            $games[$_POST['gameOption']-1]);
        $halo->setReviewId($_POST['pNo']);

        if ($halo->getReviewId() === '-1') {
            //add
            HaloController::addReview($halo);
        } else {
            //update
            HaloController::updateReview($halo);
        }

        //return to review list
        header('Location: ./display_halo.php');
    }

    if (isset($_POST['cancel'])) {
        //cancel button - just go back to list
        header('Location: ./display_halo.php');
    }
?>
<html>
<head>
<link rel="icon" href="../admin_view/images/gri.png" type="image/png">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Welcome to our Halo Game Reviews</title>
</head>

<body>
<div class="background-image"></div>
    <h1>Welcome to out Halo Game Reviews</h1>
    <h2><?php echo $pageTitle; ?></h2>
    <form method='POST'>
        <h3>EMail: <input type="text" name="eMail"
            value="<?php echo $halo->getEMail(); ?>">
        </h3>
        <h3>Rating: <input type="int" name="rating"
            value="<?php echo $halo->getRating(); ?>">
        </h3>
        <h3>Review: <input type="text" name="review"
            value="<?php echo $halo->getReview(); ?>">
        </h3>
        <h3>Review Post Date: <input type="date" name="start"
            value="<?php echo $halo->getReviewPostDate(); ?>">
        </h3>
       
        </h3>
        <input type="hidden"
            value="<?php echo $halo->getReviewId(); ?>" name="pNo">
        <input type="submit" value="Save" name="save">
        <input type="submit" value="Cancel" name="cancel">
    </form>
</body>
</html>