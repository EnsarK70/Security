<?php

function caesarCipher($shift, $message) {
    $result = "";

    for ($i = 0; $i < strlen($message); $i++) {
        $char = $message[$i];

        if (ctype_lower($char)) {
            $result .= chr((ord($char) - ord('a') + $shift) % 26 + ord('a'));
        } else {
            $result .= $char;
        }
    }

    return $result;
}

echo "enter shift number: ";
$shift = trim(fgets(STDIN));

echo "enter message: ";
$message = trim(fgets(STDIN));

$encryptedMessage = caesarCipher($shift, $message);
echo $encryptedMessage . PHP_EOL;

?>