<!-- HABE_login.php -->

<?php
if (isset($_POST["aanmelden"])) {
	$email = htmlspecialchars($_POST["email"]);
	$wachtwoord = htmlspecialchars($_POST["wachtwoord"]);
	require 'HABE_connection.php';
	$sql = "SELECT * FROM gebruikers WHERE Email='$email'";
	$result = $conn->query($sql);
	// check of het ingegeven naam/wachtwoord in de database zit
	if ($result->num_rows == 1) {
		$row = mysqli_fetch_array($result); 
		//  check of het wachtwoord klopt met het geencrypteerde wachtwoord in de database
		if (password_verify($wachtwoord, $row["Wachtwoord"])) {
			session_start();
			$_SESSION["login"] =$email;
			header('Location: index.php');
		} else {
			echo '<span style="color:#FE1010;">Ongeldig wachtwoord. Probeer opnieuw. <hr>';
		} 
		$conn->close();
	} else { 
			echo '<span style="color:#FE1010;">Ongeldig email. Probeer opnieuw. <hr>';
	}
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<?php 
require 'layout/HABE_style.php';
?> 
<meta charset="UTF-8">
<title> HABE_login </title>
</head>
<body>
<form method="POST"> 
<label for="email">E-mailadres</label>
<input type="email" name="email"><br><br>
<label for="wachtwoord">Wachtwoord</label>
<input type="password" name="wachtwoord"><br><br>
<input type="submit" name="aanmelden" value="aanmelden"><br><br>
</form>
<p>Nog geen account? <a href="HABE_registratie.php">registreer hier</a>.</p>
</body>
</html>