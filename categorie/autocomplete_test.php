<style> 
  div.product {
      display: inline-block;
      width: 500px;
      text-align: center;
  }
  div.desc {
      display: inline-block;
      width: 500px;
      font-size: 16px;
      color: white;
      text-align: left;
      text-align: top;
  }
  div.status {
      display: inline-block;
      width: 200px;
      font-size: 16px;
      color: white;
      text-align: left;
      text-align: top;
  }
  </style>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Autocomplete</title>
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
 
  <!-- Script -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 
 <!-- jQuery UI -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
 </head>

<?php require '../layout/HABE_header.php';
?>
<h1> <?php $product ?> </h1>
<!-- <img src="/dashboard/IT/GIP/images/thumbnails/<?php #echo $product; ?>.png" alt="Constructie" width="256" height="256">-->
<br>
<form>
<body> 
<div class="container">
  <div class="row">
     <h2>Search Here</h2>
     <input type="text" name="search" id="search" placeholder="search here...." class="form-control">  
  </div>
</div>
<script type="text/javascript">
  $(function() {
     $( "#search" ).autocomplete({
       source: 'autocomplete_product.php',
     });
  });
</script>
</form>
<br>
<a href="../index.php">keer terug</a>
<br>
<a href="../categorie/autocomplete_test.html">Work in progress zoekbalk met suggesties</a>
<br>
<?php
if (isset($_GET["trefwoord"])){
    $trefwoord = $_GET["trefwoord"];
} else {
    $trefwoord = "";
} 
?>
<br>
<?php
require '../HABE_connection.php';
require '../layout/HABE_style.php';

?>
</body>
</html>