<?php
session_start();
$servername = "localhost:3307";
$username = "root"; // PAS DEZE AAN ALS DAT NODIG IS
$password = ""; // PAS DEZE AAN ALS DAT NODIG IS
$db = "leaky_guest_book";
$conn;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Voeg deze regel toe om fouten te tonen
} catch (Exception $e) {
    die("Failed to open database connection, did you start it and configure the credentials properly?");
}

// Voeg een functie toe om HTML en SQL te ontsnappen om XSS- en SQL-injectie-aanvallen te voorkomen
function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

?>
<html>
<head>
    <title>Leaky-Guestbook</title>
    <style>
        body {
            width: 100%;
            background-color: <?php echo isset($_GET['color']) ? escape($_GET['color']) : 'aliceblue'; ?>;
        }

        .body-container {
            width: 200px;
            height: 100%;
            margin-left: auto;
            margin-right: auto;
            padding-left: 100px;
            padding-right: 100px;
        }

        .heading {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="body-container">
    <h1 class="heading">Gastenboek 'De lekkage'</h1>
    <form action="guestbook_get.php">
        Email: <input type="email" name="email"><br/>
        <input type="hidden" value="red" name="color">
        Bericht: <textarea name="text" minlength="4"></textarea><br/>
        <?php if (userIsAdmin($conn)) {
            echo "<input type=\"hidden\" name=\"admin\" value=" . escape($_COOKIE['admin']) . ">";
        } ?>
        <input type="submit">
    </form>
    <hr/>
    <?php
    if (isset($_GET['email']) && isset($_GET['text'])) {
        echo "<div style=\"color: red\">Email: " . escape($_GET['email']);
        echo ": " . escape($_GET['text']) . "</div><br/>";
    }

    $result = $conn->query("SELECT `email`, `text`, `color`, `admin` FROM `entries`");
    foreach ($result as $row) {
        echo "<div style=\"color: " . escape($row['color']) . "\">Email: " . escape($row['email']);
        if ($row['admin']) {
            echo '&#9812;';
        }
        echo ": " . escape($row['text']) . "</div><br/>";
    }

    function userIsAdmin($conn)
    {
        if (isset($_COOKIE['admin'])) {
            $adminCookie = escape($_COOKIE['admin']);

            $result = $conn->query("SELECT cookie FROM `admin_cookies`");

            foreach ($result as $row) {
                if ($adminCookie === escape($row['cookie'])) {
                    return true;
                }
            }
        }
        return false;
    }

    ?>
</div>
</body>
</html>