<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
}
/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
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
</head>     
<body>

<?php require '../layout/HABE_header.php';
?>
<h1> <?php $product ?> </h1>
<!-- <img src="/dashboard/IT/GIP/images/thumbnails/<?php #echo $product; ?>.png" alt="Constructie" width="256" height="256">-->
<br>

<br>
<a href="/dashboard/IT/GIP/index.php">keer terug</a>
<br>
<a href="/dashboard/IT/GIP/categorie/autocomplete_test.html">Work in progress zoekbalk met suggesties</a>
<br>
<?php
if (isset($_GET["trefwoord"])){
    $trefwoord = $_GET["trefwoord"];
} else {
    $trefwoord = "";
} 
?>

<br>
<form autocomplete="off" action="/action_page.php">
  <div class="autocomplete" style="width:300px;">
    <input id="myInput" type="text" name="trefwoord" placeholder="cpu">
  </div>
  <input type="submit">
</form>
<?php
require_once 'opt\lampp\htdocs\HABE_connection.php';
require '..\layout\HABE_style.php';
$sql = "SELECT * FROM $product WHERE name LIKE '%$trefwoord%' AND status NOT LIKE 'Discontinued' AND `Vertical Segment` LIKE 'desktop'";
$result = $conn->query($sql);
echo $sql;
$_SESSION["product"] = $product;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="product">';
        echo '<div class="desc">' . $row["name"] . " "  . "<br>" . "<br>" . '</div>';
        echo '<div class="status">' . $row["Status"] . "<br>" . "<br>" . "<br>" . '</div>';
        echo '<img src="/dashboard/IT/GIP/images/processors/' . $row["name"] . '.jpg' . '" alt="Constructie" width="256" height="256">';
    }
} else {
    echo "0 results";
}
?>

<script>
function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          b.addEventListener("click", function(e) {
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) {
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}
var processors = <?php $row["name"]?>
trefwoord(document.getElementById("myInput"), processors);
</script>



<?php
require '..\layout/HABE_footer.php';

?>
</body>
</html>