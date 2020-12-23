<?php
$servername = "localhost";
$username = "root";
$password = "ebahroot";
$dbname = "habe";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM comments";
$result = $conn->query($sql);
?>
