<?php
$registreren = 5;
if (isset($_POST["registreren"]))
{
    $input = $_POST["input"];
    $registreren = $_POST["registreren"];
    // check of CAPTCHA correct is ingevuld
    if (isset($_SESSION['captcha_string']) && $input == $_SESSION['captcha_string'])
    {
        $email = htmlspecialchars($_POST["email"]);
        $wachtwoord = htmlspecialchars($_POST["wachtwoord"]);
        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $naam = htmlspecialchars($_POST["naam"]);
        $geboortejaar = htmlspecialchars($_POST["geboortejaar"]);
        // controleren of de input juist is
        $foutboodschap = "";
        if (strlen(trim($email)) < 3) {
            $foutboodschap .= "onjuist email. <br>" ;
        }
        if (strlen(trim($wachtwoord)) < 8) {
            $foutboodschap .= "onveilig wachtwoord. <br>" ;
        }
        if (strlen(trim($naam)) < 2) {
            $foutboodschap .= "Ongeldige naam. <br>" ;
        }
        if ((! is_numeric($geboortejaar)) or ($geboortejaar < 1900)) {
            $foutboodschap .= "ongeldig geboortejaar. <br>" ;
        }
        if (strlen($foutboodschap) > 0) {
			echo "<body style='background-color:black'>";
			$kleur = "red";
			echo '<span style="Color:#FE1010">'.$foutboodschap. '</span>';
			echo "<br><a href='HABE_registratie.php'> Ga terug en probeer opnieuw.</a>";
        }else{
            require 'HABE_connection.php';
            if ($result->num_rows > 0) {
                echo "sorry dit email is reeds in gebruik <br>";
                echo "<a href='HABE_login.php'>Meld je hier aan</a>";
            } else {
                $sql = "INSERT INTO gebruikers (Email, Wachtwoord, Naam, Geboortejaar)
                VALUES ('$email', '$hash', '$naam', $geboortejaar)";
                echo "<hr>$sql<hr>";
                if ($conn->query($sql) === TRUE) {
                    echo "Meld je nu aan.";
                    header('Location: HABE_login.php');
                die();
                } else {
                    echo "Registratie mislukt.";
                }
            }
            $conn->close();
        }    
    } else {
		echo "<span style='color:#FE1010;'>CAPTCHA onjuist";
        create_image();
        display();
    }
} else {
    create_image();
    display();
}
?>