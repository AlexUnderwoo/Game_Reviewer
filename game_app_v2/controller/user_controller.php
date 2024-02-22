<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the user controller file. 
 
   -->
<?php
require_once('model/user_db.php');
require_once('user.php');

class UserController {
    //helper function to convert a db row into a 
    //User object
    Private static function rowToUser($row) {
        $user = new User(
            $row['UserId'],
            $row['LastName'],
            $row['EMail'],
            $row['Password'],
            $row['RegistrationDate'],
            $row['UserLevel'],
            $row['UserId']);
        return $user;
    }

    //function to check login credentials - return true
    //if user is valid, false otherwise
    public static function validUser($email, $password) {
        $queryRes = UsersDB::getUserByEMail($email);

        if ($queryRes) {
            //process the user row
            $user = self::rowToUser($queryRes);
            if ($user->getPassword() === $password) {
                return $user->getUserLevel();
            } else {
                return false;
            }
        } else {
            //either no such user or db connect failed - 
            //either way, can't validate the user
            return false;
        }
    }
}