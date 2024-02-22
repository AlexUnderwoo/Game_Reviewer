<!--
Rodney Dugger Dr
Stephen Platts
Alexander Underwood
Date: 2/11/2024
App Name: Game Rating App

    This is the user objects file. 
 
   -->
<?php
//Class to represent an entry in the users table
class User {
    //properties - match the columns in the users table
    private $userId;
    private $firstName;
    private $lastName;
    private $eMail;
    private $password;
    private $registrationDate;
    private $userLevel;

    public function __construct($firstName, $lastName, 
        $eMail, $password, $registrationDate, $userLevel,
        $userId = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->eMail = $eMail;
        $this->password = $password;
        $this->registrationDate = $registrationDate;
        $this->userLevel = $userLevel;
        $this->userId = $userId;
    }

    //get and set the person properties
    public function getUserId() {
        return $this->userId;
    }
    public function setPersonNo($value) {
        $this->userId = $value;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($value) {
        $this->firstName = $value;
    }

    public function getLastName() {
        return $this->lastName;
    }
    public function setLastName($value) {
        $this->lastName = $value;
    }
    public function getEMail() {
        return $this->eMail;
    }
    public function setEMail($value) {
        $this->eMail = $value;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($value) {
        $this->password = $value;
    }

    public function getRegistrationDate() {
        return $this->registrationDate;
    }
    public function setRegistrationDate($value) {
        $this->registrationDate = $value;
    }

    public function getUserLevel() {
        return $this->userLevel;
    }
    public function setUserLevel($value) {
        $this->userLevel = $value;
    }

    //function created to try and pull UserId from table
    public static function getUserIdByEmail($email, $password) {
        $host = 'localhost';
        $dbname = 'game_app_v2';
        $username = 'root';
        $password = '';
    
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Prepare SQL statement to retrieve user ID based on email and password
            $sql = "SELECT UserId FROM users WHERE EMail = ? AND Password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email, $password]);
    
            // Fetch the user ID
            $user_id = $stmt->fetchColumn();
    
            // Close connection
            $conn = null;
    
            // Return the user ID
            return $user_id;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    //Alex Underwood
    public static function updatePassword($email, $current_password, $new_password) {
        $host = 'localhost';
        $dbname = 'game_app_v2';
        $username = 'root';
        $password = '';
    
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Check if the current email and password are correct
            $sql = "SELECT UserId FROM users WHERE Email = :email AND Password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $current_password);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user !== false) {

                // Check if the new password meets requirements
            if (strlen($new_password) < 8) {
                return "Password must be at least 8 characters long.";
            } elseif (!preg_match('/[0-9]/', $new_password)) {
                return "Password must contain at least one digit.";
            } elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $new_password)) {
                return "Password must contain at least one special character.";
            }

                // Update password
                $sql = "UPDATE users SET Password = :new_password WHERE UserId = :user_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':new_password', $new_password);
                $stmt->bindParam(':user_id', $user['UserId']);
                $stmt->execute();
                return true; // Password updated successfully
            } else {
                return false; // Invalid email or password
            }
    
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Error occurred
        }
    
        $conn = null;
    }
    
    
}
