<!-- HABE_registreren.php -->

<?php
session_start();
function display() {
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
<?php 
require 'layout/HABE_style.php';
?> 
<meta charset="UTF-8">
<title> HABE_registratie </title>
</head>
<body>

<label for="foutmelding"><?php $foutmelding ?></label>
<h1> Registreren </h1>
<form method="POST"> 
<label for="email">E-mail:</label>
<input type="email" name="email" placeholder="vul je e-mail adres in" required><br><br>
<label for="wachtwoord">Wachtwoord:</label>
<input type="password" name="wachtwoord" placeholder="kies een wachtwoord" required><br><br>
<label for="naam">Naam:</label>
<input type="text" name="naam" placeholder="vul je naam in" required><br><br>
<label for="geboortejaar">Geboortejaar:</label>
<input type="text" name="geboortejaar" placeholder="in welk jaar ben je geboren" required><br><br>
<div style="display:block;margin-bottom:20px;margin-top:20px;">
<img src="images/captcha.png"><br>
</div>
<form action=" <? echo $_SERVER['PHP_SELF']; ?>" method="POST"/>
    <input type="text" name="input" placeholder="vul de karakters in"/>
    <input type="hidden" name="registreren" value="1"/>
    <input type="submit" value="Registreren" name="registreren" class="buttonElement"/><br><br>
    <input type="submit" value="Refresh Page" onClick="window.location.reload();">
    <p>Al geregistreerd? <a href="HABE_login.php">login hier</a>.</p>
    </form>
    <?php
    }
// Maakt nieuwe afbeelding voor captcha aan     
require "HABE_captcha.php";
require "HABE_input_validation.php";
?>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
</body>