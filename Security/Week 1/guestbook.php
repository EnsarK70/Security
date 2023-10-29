<?php
session_start();
$servername = "localhost:3307";
$username = "root"; // PAS DEZE AAN ALS DAT NODIG IS
$password = ""; // PAS DEZE AAN ALS DAT NODIG IS
$db = "leaky_guest_book";
$conn;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
} catch (Exception $e) {
    die("Failed to open the database connection, did you start it and configure the credentials properly?");
}

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];
?>
<html>
<head>
    <title>Leaky-Guestbook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="body-container">
        <h1 class="heading">Gastenboek 'De lekkage'</h1>
        <form action="guestbook.php" method="post">
            Email: <input type="text" name="email"><br/>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                // Voer e-mailvalidatie uit
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "Ongeldig e-mailadres. Voer een geldig e-mailadres in.";
                } else {
                    $text = $_POST['text'];
                    $admin = isset($_POST['admin']) ? 1 : 0;
                    $color = $_POST['color'];
                    $conn->query(
                        "INSERT INTO `entries`(`email`, `color`, `admin`, `text`) 
                                                VALUES ('$email', '$color', '$admin', '$text');"
                    );
                }
            }
            ?>
            <input type="hidden" value="<?php echo userIsAdmin($conn) ? 'admin_color' : 'red'; ?>" name="color">
            Bericht: <textarea name="text" minlength="4"></textarea><br/>
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <input type="submit">
        </form>
        <hr/>
        <?php
        $result = $conn->query("SELECT `email`, `text`, `color`, `admin` FROM `entries`");
        foreach ($result as $row) {
            print "<div style=\"color: " . $row['color'] . "\">Email: " . $row['email'];
            if ($row['admin']) {
                print '&#9812;';
            }
            print ": " . $row['text'] . "</div><br/>";
        }

        function userIsAdmin($conn)
        {
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
        <hr/>
        <div class="disclosure-notice">
            <p>
                Hierbij krijgt iedereen expliciete toestemming om dit Gastenboek zelf te gebruiken voor welke doeleinden dan ook.
            </p>
            <p>
                Onthoud dat je voor andere websites altijd je aan de principes van
                <a href="https://en.wikipedia.org/wiki/Responsible_disclosure" target="_blank" style="color: lightgray;">
                    Responsible Disclosure
                </a> wilt houden.
            </p>
        </div>
    </div>
</body>
</html>