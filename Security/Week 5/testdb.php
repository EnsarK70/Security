<?php
// Verbinding maken met de database
$host = 'localhost:3306'; // Verander naar jouw databasehost
$dbname = 'testdb'; // Verander naar jouw databasenaam
$username = 'root'; // Verander naar jouw databasegebruikersnaam
$password = ''; // Verander naar jouw database wachtwoord

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Voorbeeld van een SQL-query met prepared statement voor UPDATE
    $sqlUpdate = "UPDATE users SET name = :name WHERE id = :id";
    $stmtUpdate = $conn->prepare($sqlUpdate);

    // Vervang deze variabelen door de waarden die je wilt bijwerken
    $name = "Nieuwe naam";
    $id = 1; // Vervang dit door het gewenste ID

    $stmtUpdate->bindParam(':name', $name, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);

    $stmtUpdate->execute();

    echo "Gegevens bijgewerkt!<br>";

    // Voorbeeld van een SQL-query met prepared statement voor INSERT
    $sqlInsert = "INSERT INTO `entries`(`email`, `color`, `admin`, `text`) VALUES (:email, :color, :admin, :text)";
    $stmtInsert = $conn->prepare($sqlInsert);

    // Vervang deze variabelen door de waarden die je wilt invoegen
    $email = "mashal@email.com";
    $color = "blauw";
    $admin = 1; // 1 voor Ja, 0 voor Nee
    $text = "Dit is een voorbeeldtekst";

    $stmtInsert->bindParam(':email', $email, PDO::PARAM_STR);
    $stmtInsert->bindParam(':color', $color, PDO::PARAM_STR);
    $stmtInsert->bindParam(':admin', $admin, PDO::PARAM_INT);
    $stmtInsert->bindParam(':text', $text, PDO::PARAM_STR);

    $stmtInsert->execute();

    echo "Gegevens ingevoegd!";
} catch (PDOException $e) {
    echo "Fout: " . $e->getMessage();
}
?>