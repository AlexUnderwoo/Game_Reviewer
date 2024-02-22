<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is search database file. This file uses java and an Ajax Extention 
    that drives the search functionallity for a live search results. This file
    includes the model/db.php file. An if and a while statement is used to 
    search data from the games table.
   -->
<?php
// Include the database configuration file.
include "../model/db.php";
// Retrieve the value of the "search" variable from "script.js".
if (isset($_POST['games'])) {
   // Assign the search box value to the $Name variable.
   $GameName = $_POST['games'];
   // Define the search query.
   $Query = "SELECT GameName FROM games WHERE GameName LIKE '%$GameName%' LIMIT 5";
   // Execute the query.
   $ExecQuery = MySQLi_query($conn, $Query);
   // Create an unordered list to display the results.
   echo '
<ul>
   ';
   // Fetch the results from the database.
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
       ?>
   <!-- Create list items.
        Call the JavaScript function named "fill" found in "script.js".
        Pass the fetched result as a parameter. -->
   <li onclick='fill("<?php echo $Result['GameName']; ?>")'>
   <a>
   <!-- Display the searched result in the search box of "search.php". -->
       <?php echo $Result['GameName']; ?>
   </li></a>
   <!-- The following PHP code is only for closing parentheses. Do not be confused. -->
   <?php
}}
?>
</ul>