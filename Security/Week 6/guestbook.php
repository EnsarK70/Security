<?php
session_start();
$servername = "127.0.0.1";
$username = "root"; // Update with your database username
$password = "toor"; // Update with your database password
$db = "leaky_guest_book";
$conn;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
} catch (Exception $e) {
    die("Failed to open the database connection. Please check your database configuration.");
}

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

$token = $_SESSION['token'];

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the token in the form matches the one stored in the session
    if ($_POST['token'] !== $token) {
        die("Invalid token. Your submission has been rejected.");
    }

    $email = $_POST['email'];
    $text = $_POST['text'];
    $admin = isset($_POST['admin']) ? 1 : 0;
    $color = $_POST['color'];

    // Add additional authorization checks if needed
    if (userIsAdmin($conn)) {
        // Perform the database insertion here
        $conn->query("INSERT INTO `entries`(`email`, `color`, `admin`, `text`) VALUES ('$email', '$color', '$admin', '$text');");
    } else {
        // Handle unauthorized user
        die("Unauthorized user. Your submission has been rejected.");
    }
}

// Rest of your code

function userIsAdmin($conn) {
    if (isset($_COOKIE['admin'])) {
        $adminCookie = $_COOKIE['admin'];

        $result = $conn->query("SELECT cookie FROM `admin_cookies`");

        foreach ($result as $row) {
            if ($adminCookie === $row['cookie']) {
                return true;
            }
        }
    }

    return false;
}
?>
