<?php
require '../layout/HABE_style.php';
require '../layout/HABE_header.php';
$product  = $_GET["categorie"];
$Id  = $_GET["id"];
?>
<style>
table {
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid gray;
}
</style>
<meta charset="UTF-8">
<title> HABE_home </title>
</head>
<body>
<h1> <?php $product ?> </h1>
<!-- <img src="/dashboard/IT/GIP/images/thumbnails/<?php #echo $product; ?>.png" alt="Constructie" width="256" height="256">-->
<br>
<br>
<a href="/categorie/<?echo $product;?>.php">keer terug</a>
<br>
<br>
<?php
require '../HABE_connection.php';


$sql = "SELECT * FROM `$product` WHERE `Id` LIKE '$Id'";
$result = $conn->query($sql);
// $colnames = $sql->getColumnNames();
$_SESSION["product"] = $product;
    // while($row = $result->fetch_assoc()) {
    //     $result_2[] = $row;

    // Print the column names as the headers of a table
    
        while ($row = $result->fetch_assoc()) {
                $column = array_keys($row);
                 $image = '../images/' . $product . '/' . $row["Productnaam"] . '.jpg';
                if(file_exists($image)){
                    echo '<br><img src="' . $image . '" style="width:270px;height:170px;"<br><br><br>';
                } else {
                    echo '<br><img src="../images/geen_afbeelding.png" style="width:270px;height:170px;"><br><br>';
                }
                echo '<div class="specs">' . $row["Prijs"] . ' op ' . $row["Verkoper"] . ':' . '</div>';
                if ($row["Prijs"] != "Geen prijs beschikbaar"){
                    echo '<a class="specs" href="' . $row["url"] . '">Shop hier</a>';
                } else { 
                    echo '<a class="specs" href="https://www.google.com/search?q=' . $row["Productnaam"] . '&sxsrf=ALeKk03amNVzZFyNTzoqf_UWwmPe2AWXiA:1589219665745&source=lnms&tbm=shop&sa=X&ved=2ahUKEwjJ95XNsKzpAhULjqQKHfDcDm0Q_AUoAXoECAwQAw&biw=1206&bih=908">Shop hier</a>';
                }
                echo "<table>";
                for($i=0; $i<sizeof($column); $i++){
                    if ($column[$i] == "Id" || $column[$i] == "Verkoper" || $column[$i] == "url"){
                        
                        
                    } else {
                        if (isset($row[$column[$i]])) {
                            echo "<tr style='color:#ffffff'><th>".$column[$i]."</th><td>".$row[$column[$i]]."</td></tr>";
                        }
                    }
                }
            }
                echo "</table>";




require '../layout/HABE_footer.php';
?>
</body>
</html>