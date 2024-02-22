<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the display_fortnite file.This file requires the 
    controller/review_controller.php. This file uses a if statement to 
    update or delete data to or from the fortnite table. A foreach array
    is added to access all data in the fortnite table. CSS code is added
    the match the home page display.  
   -->
<?php
require_once('../controller/fortnite.php');
require_once('../controller/fortnite_controller.php');
require_once("../controller/game.php");
require_once('../controller/game_controller.php');

//review controller
$fortnites = FortniteController::getAllReviews();

if (isset($_POST['update'])) {
    //update button pressed for a user
    if (isset($_POST['pNoUpd'])) {
        header('Location: ./add_update_fortnite.php?pNo=' . $_POST['pNoUpd']);
    }
    unset($_POST['update']);
    unset($_POST['pNoUpd']);
}

if (isset($_POST['delete'])) {
    //delete button pressed for a user
    if (isset($_POST['pNoDel'])) {
        FortniteController::deleteReview($_POST['pNoDel']);
    }
    unset($_POST['delete']);
    unset($_POST['pNoDel']);
}


?>
<html>
<head>
    <!-- CSS style code -->
    <link rel="icon" href="../admin_view/images/gri.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Welcome to our Fortnite Game Reviews</title>
</head>

<body>
<div class="background-image"></div>
    <h1>Welcome to our Fortnite Game Reviews</h1>
    <h1>Fortnite Review List</h1>
    <h2><a href="./add_update_fortnite.php">Add Review</a></h2>
    <table>
        <tr>
            <th>EMail</th>
            <th>Rating</th>
            <th>Review</th>
            <th>Review Post Date</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            </tr>
            <!-- Foreach array used to collect all data from fortnite table -->
            <?php foreach (FortniteController::getAllReviews() as $fortnite) : ?>
            <tr>
                <td><?php echo $fortnite->getEMail(); ?></td>
                <td><?php echo $fortnite->getRating(); ?></td>
                <td><?php echo $fortnite->getReview(); ?></td>
                <td><?php echo $fortnite->getReviewPostDate(); ?></td>
                <td><form method="POST">
                    <input type="hidden" name="pNoUpd"
                        value="<?php echo $fortnite->getReviewId(); ?>"/>
                    <input type="submit" value="Update" name="update" />
                </form></td>
                <td><form method="POST">
                    <input type="hidden" name="pNoDel"
                        value="<?php echo $fortnite->getReviewId(); ?>"/>
                    <input type="submit" value="Delete" name="delete" />
                </form></td>
            </tr>
            <?php endforeach; ?>
    </table>
        <h3><a href="../admin_view/display_admin.php">Home</a></h3>
</body>
</html>
