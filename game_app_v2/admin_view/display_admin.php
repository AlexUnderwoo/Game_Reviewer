<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the admin home page file.This file requires the util/security.php. 
    Login and logout security is provided. This page provides a link to each 
    of the games available for a rating and a review from the user. A title,
    heading an and form is added to displat a web page and links to games.
    A search functionallity is added using Ajax extention to it's library and
    java script links. This allow functionallity to the search field, allowing
    the user to enter a search for a game. CSS code is added to match the home 
    screen display.  
   -->

<?php
session_start();
require_once('../util/security.php');

//confirm user is authorized for the page
Security::checkAuthority('admin');

//user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}
?>
<html>
<head>
<link rel="icon" href="../admin_view/images/gri.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Welcome To Online Gaming App</title>
</head>

<body>
    <div class="background-image"></div>
    <h1>Welcome To Online Gaming Rating App</h1>
    <?php # include 'views/search_form.php'; ?>
    
    <h2>Please select a game you would like to rate!</h2>

    <main>
    <h1>Game Selections:</h1>
    <ul>
    <li><h2><a href="display_battle_royale.php">
         Battle Royale</a></h2></li><?php echo "A multi player game with several gaming options to a last man standing weapons fight to the end!"?>
    <li><h2><a href="display_fortnite.php">
        Fortnite</a></h2></li><?php echo "A multi player game with great visuals and fan fair to a last man standing weapons fight to the end!"?>
    <li><h2><a href="display_halo.php">
        Halo</a></h2></li><?php echo "A multi player game fight to a last man standing!"?>
    <li><h2><a href="display_games.php">
        Games</a></h2></li><?php echo "A list of all our games for review!"?>
    <li><h2><a href="contact_info.php">
        Contact Info
    </a></h2></li>
    <li><h2><a href="update_password_admin.php">
        Update Password
    </a></h2></li>
    <li><h2><a href="user_accounts.php">
        User Accounts Management
    </a></h2></li>
    </ul>
    </main>

    <h2>Please enter a search for games in our database:</h2>
   <!-- jQuery library is required. -->
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <!-- Include our script file. -->
   <script type="text/javascript" src="script.js"></script>
   <!-- Include the CSS file. -->
   <link rel="stylesheet" type="text/css" href="style.css">

   <input type="text" id="games" placeholder="Search" />
    <br></br>
   <?php echo 'Search Results:'; ?>
   <!-- Suggestions will be displayed in the following div. -->
   <div id="display"></div>
   <br>
   <br/>
   <br>
   </br>

    <form method='POST'>
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>