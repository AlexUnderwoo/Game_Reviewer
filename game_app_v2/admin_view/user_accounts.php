<?php
//Alex Underwood- User Management Page
session_start();

// Check if user is logged in as admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: display_admin.php");
    exit();
}

// Database connection
$host = 'localhost';
$dbname = 'game_app_v2';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete user if requested
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $userId = $_GET['delete'];
    $sql = "DELETE FROM users WHERE UserId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
}

// Fetch user accounts
$sql = "SELECT UserId, EMail, FirstName, LastName FROM users";
$result = $conn->query($sql);

?>

<html>
<head>
<link rel="icon" href="../admin_view/images/gri.png" type="image/png">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>User Accounts</title>
</head>
<body>
<div class="background-image"></div>
    <h2>User Accounts</h2>
    <table border="1">
        <tr>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['EMail'] . "</td>";
                echo "<td>" . $row['FirstName'] . "</td>";
                echo "<td>" . $row['LastName'] . "</td>";
                echo "<td><a href='user_accounts.php?delete=" . $row['UserId'] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="display_admin.php">Back to Admin Panel</a>
</body>
</html>

<?php
$conn->close();
?>
