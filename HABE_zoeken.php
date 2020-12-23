<?php
require "HABE_connection.php";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["Name"] . " <br>\n";
        echo $row["Release_Quarter"] . "</a><br>\n";
        echo $row["Release_Year"] . " <hr>\n ";
        echo $row["Cores"] . " <br>\n";
        echo $row["Max_Turbo_speed"] . " <br>\n";
        echo $row["Base_Speed"] . " <br>\n";
        echo $row["Cache_Size"] . " <br>\n";
    }
}
?>