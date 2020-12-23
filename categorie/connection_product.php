<?php
require '../layout/HABE_style.php';
require '../layout/HABE_header.php';
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$results_per_page = 100;
$start_from = ($page-1) * $results_per_page;
?>
<meta charset="UTF-8">
<title> HABE_home </title>
</head>
<body>
<h1> <?php $product ?> </h1>
<!-- <img src="/dashboard/IT/GIP/images/thumbnails/<?php #echo $product; ?>.png" alt="Constructie" width="256" height="256">-->
<a href="../index.php">keer terug</a>
<br>
<br>
<form>
    <form class="form-inline my-2 my-lg-0">
    <span>
        <input name="trefwoord" id="search" class="form-control mr-sm-2" style="width: 30%;" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Zoeken" name="zoeken">Search</button>
    </span>
    </form>

    <script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            $( "#search" ).autocomplete({
            source: 'autocomplete_product.php',
            });
        });
    });
    </script>
</form>
<br>
<?php
if (isset($_GET["trefwoord"])){
    $trefwoord = $_GET["trefwoord"];
} else {
    $trefwoord = "%";
} 
?>
<br>
<?php
require '../HABE_connection.php';
$sql = "SELECT * FROM `$product` WHERE `Productnaam` LIKE '%$trefwoord%' LIMIT $start_from, ".$results_per_page;
$result = $conn->query($sql);
$_SESSION["product"] = $product;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<a href='/categorie/product.php?categorie=" . $product . "&id=" . $row["Id"] . "'>";
            echo '<div class="product">';
                echo '<div class="productnaam">' . $row["Productnaam"] . '</div>';
                echo '<div class="specs">' . $row["Prijs"] . ' op ' . $row["Verkoper"] . ':' . '</div>';
                if ($row["Prijs"] != "Geen prijs beschikbaar"){
                    echo '<a class="specs" href="' . $row["url"] . '">Shop hier</a>';
                } else { 
                    echo '<a class="specs" href="https://www.google.com/search?q=' . $row["Productnaam"] . '&sxsrf=ALeKk03amNVzZFyNTzoqf_UWwmPe2AWXiA:1589219665745&source=lnms&tbm=shop&sa=X&ved=2ahUKEwjJ95XNsKzpAhULjqQKHfDcDm0Q_AUoAXoECAwQAw&biw=1206&bih=908">Shop hier</a>';
                }
                $image = '../images/' . $product . '/' . $row["Productnaam"] . '.jpg';
                if(file_exists($image)){
                    echo '<br><img src="' . $image . '" style="width:270px;height:170px;"<br><br><br>';
                } else {
                    echo '<br><img src="../images/geen_afbeelding.png" style="width:270px;height:170px;"><br><br>';
                }
            echo '</div>';
        echo '</a>';
    }
    $sql = "SELECT COUNT(Id) AS total FROM `$product`";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_pages = ceil($row["total"] / $results_per_page);
    echo "<br>";
    for ($i=1; $i<=$total_pages; $i++) { 
        echo "<a href='/categorie/" . $product . ".php?page=" . $i . "'>" . $i . "</a> "; 
    };     
} else {
    echo "0 results";
}
require '../layout/HABE_footer.php';
?>
</body>
</html>