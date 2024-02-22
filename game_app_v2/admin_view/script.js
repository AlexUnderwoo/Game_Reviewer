/*
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the JS script file. This file is used to provide functionallity to
    the Ajax search function. 
*/
// Retrieve the value from "ajax.php".
function fill(Value) {
    // Assign the value to the "search" div in "search.php".
    $('#games').val(Value);
    // Hide the "display" div in "search.php".
    $('#display').hide();
}
$(document).ready(function() {
    // When a key is pressed in the "Search box" of "search.php", this function will be called.
    $("#games").keyup(function() {
        // Assign the search box value to a JavaScript variable named "name".
        var gname = $('#games').val();
        // Validate if "name" is empty.
        if (gname == "") {
            // Assign an empty value to the "display" div in "search.php".
            $("#display").html("");
        }
        // If the name is not empty.
        else {
            // Initiate an AJAX request.
            $.ajax({
                // Set the AJAX type as "POST".
                type: "POST",
                // Send data to "ajax.php".
                url: "ajax.php",
                // Pass the value of "name" into the "search" variable.
                data: {
                    games: gname
                },
                // If a result is found, this function will be called.
                success: function(html) {
                    // Assign the result to the "display" div in "search.php".
                    $("#display").html(html).show();
                }
            });
        }
    });
 });