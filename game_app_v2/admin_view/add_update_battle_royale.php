<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the update add delete Controller file for Battle Royale.
    This file requires controller/battle _royale_controller.php and controller
    /game_controller.php. All data in table battle_royale is added, updated, or 
    deleted using the if statements and Battle Royale Controller. A title,
    heading an and form is added to displat a web page to display the updated
    data collected in the battle royale database table using the POST method. 

   -->
<?php
    require_once('../controller/battle_royale.php');
    require_once('../controller/battle_royale_controller.php');
    require_once('../controller/game.php');
    require_once('../controller/game_controller.php');


    $battle_royales = Battle_RoyaleController::getAllReviews();

    //default review for add - empty strings and first role
    //in list
    $battle_royale = new Battle_Royale('', '', '', date('Y-m-d'));
    $battle_royale->setReviewId(-1);
    $pageTitle = "Add Review";

    //Retrieve the reviewNo from the query string and
    //and use it to create a review object for that pNo
     if (isset($_GET['pNo'])) {
        $battle_royale =
            Battle_RoyaleController::getReviewById($_GET['pNo']);
        $pageTitle = "Update an Existing Review";
    }
 
    if (isset($_POST['save'])) {
        //save button - perform add or update
        //gameOptions are 1, 2, 3...the $games array is base
        //0 index, so subtract 1 from the selected option to
        //get the correct index
        $battle_royale = new Battle_Royale($_POST['eMail'], $_POST['rating'],
                            $_POST['review'],$_POST['start'],
                            $games[$_POST['gameOption']-1]);
        $battle_royale->setReviewId($_POST['pNo']);

        if ($battle_royale->getReviewId() === '-1') {
            //add
            Battle_RoyaleController::addReview($battle_royale);
        } else {
            //update
            Battle_RoyaleController::updateReview($battle_royale);
        }

        //return to review list
        header('Location: ./display_battle_royale.php');
    }

    if (isset($_POST['cancel'])) {
        //cancel button - just go back to list
        header('Location: ./display_battle_royale.php');
    }
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="icon" href="../admin_view/images/gri.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Welcome to our Battle Royale Game Reviews</title>
</head>

<body>
<div class="background-image"></div>
    <h1>Welcome to out Battle Royale Game Reviews</h1>
    <h2><?php echo $pageTitle; ?></h2>
    <form method='POST'>
        <h3>EMail: <input type="text" name="eMail"
            value="<?php echo $battle_royale->getEMail(); ?>">
        </h3>
        <h3>Rating: <input type="int" name="rating"
            value="<?php echo $battle_royale->getRating(); ?>">
        </h3>
        <h3>Review: <input type="text" name="review"
            value="<?php echo $battle_royale->getReview(); ?>">
        </h3>
        <h3>Review Post Date: <input type="date" name="start"
            value="<?php echo $battle_royale->getReviewPostDate(); ?>">
        </h3>
       
        </h3>
        <input type="hidden"
            value="<?php echo $battle_royale->getReviewId(); ?>" name="pNo">
        <input type="submit" value="Save" name="save">
        <input type="submit" value="Cancel" name="cancel">
    </form>
</body>
</html>