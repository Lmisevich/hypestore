<?php
declare(strict_types = 1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoecirus.com</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: "Audiowide", sans-serif;
}

.header {
  overflow: hidden;
  background-color: #1E90FF;
  padding: 10px 10px;
  width: 100%;
  box-shadow: 10px 10px 5px lightblue;
  
}

.header a {
  float: center;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;


  border-radius: 4px;
}

.icon{
  width: 50px;
  height: 50px;
  float: left;
}

h2{
  font-family: "Audiowide", sans-serif;
}

h3{
  text-align:center;
  font-size: 50px;
  font-family: "Audiowide", sans-serif;
}

.icon-right{
  width: 50px;
  height: 50px;
  float: right;
  margin-right: 10px;
  
}


.dart {
    display:block; 
    text-align: center;

    margin-left: auto;
    margin-right: auto; 
    width: 100px;
    height:100px;
    border-radius:50%;

}

.table{
  margin-left: auto;
  margin-right: auto;
  border: 10px dodgerblue;
  border-style: groove;
  padding-bottom: 5px;
  padding-top: 10px;
  padding-left: 10px;
  padding-right: 10px;
  margin-bottom: 10px;
}



.header a.active {
  background-color: dodgerblue;
  color: black;
}


/*@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: center;
  }
*/


</style>
</head>
<body>

<div class="header">
  <a href="customermain.php" class="logo"><img class = "dart" src ="shoeimage/CompanyLogo.png" alt = "Company Logo" ></a>
  <a class="active" href="customermain.php"><img class = "icon" src ="shoeimage/Home.png" alt = "Home Page" ></a>
  <a href = "GroupProjectlogin.html"><img class = "icon-right" src = "shoeimage/Logout.png" alt = "Logout"></a>
    <a href="order_tracker.php"><img class = "icon-right" src ="shoeimage/OrderTracker.png" alt = "Orders" ></a>
    <a href="shoppingcart2.php"><img class = "icon-right" src ="shoeimage/ShoppingCart.png" alt = "Shopping Cart" ></a>
  </div>
</div>


    <?php
include ('secrets.php');
session_start();

try { 
    $dsn = "mysql:host=courses;dbname=".$username;
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
    catch(PDOexception $e) { 
    echo "Connection to database failed: " . $e->getMessage();
    }
$rs = $pdo->prepare("SELECT * FROM INVENTORY, SHOPPING_CART WHERE userName = ? AND INVENTORY.productID = SHOPPING_CART.productID");
$rs->execute(array($_SESSION["username"]));
$rows= $rs-> fetchAll(PDO::FETCH_ASSOC);

if (sizeof($rows) == 0)
{
  echo 'Your shopping cart is empty :(. <a href ="customermain.php">Click here to change that!</a>';
}


else{
  $count = 0;
  $price = 0;
  while($count != sizeof($rows))
  {
  echo '<div class= "item">';
  echo '<img src = "shoeimage/'. $rows[$count]["productID"].'.png">';
    echo $rows[$count]["price"]. "<br>";
    echo $rows[$count]["productName"]. "<br>";

    echo '<form method = "POST">';
    echo'<label for="orderQTY">QTY:</label>
    <select name="orderQTY" id="orderQTY">';
    if ($rows[$count]["orderQTY"] == 1)
    {
    echo'<option value="1" selected>1</option>
    <option value="2">2</option>';
    }

    else if ($rows[$count]["orderQTY"] == 2)
    {
    echo'<option value="1">1</option>
    <option value="2" selected>2</option>';
    }
    echo'</select>';
    echo '<input type ="hidden" name = "productID" value ="'.$rows[$count]["productID"]. '">';
    echo '<input type ="submit" name = "Update QTY" value ="Update QTY">';
    echo '</form>';
    $price += $rows[$count]["price"] * $rows[$count]["orderQTY"];

    echo '<form method ="POST">';
    echo '<input type ="hidden" name = "productID" value ="'.$rows[$count]["productID"]. '">';
    echo '<input type ="submit" name = "Remove" value ="Remove">';
    echo '</form>';

    $count = $count+1;

    echo '</div>';
  }

  echo "\n$price";

echo '<br><a href = "checkout.php"><button>Proceed to Checkout</button></a>';
}
if($_POST)
{
if ($_POST["orderQTY"] == NULL)
{
    $rs = $pdo->prepare("DELETE FROM SHOPPING_CART WHERE userName = ? AND productID = ? ");
    $rs->execute (array($_SESSION["username"], $_POST["productID"]));
    echo "<meta http-equiv='refresh' content='0'>";

}

else
{
    try{
    $rs = $pdo->prepare("UPDATE SHOPPING_CART SET orderQTY = ? WHERE userName = ? and productID = ? ");
    $rs->execute (array($_POST["orderQTY"],$_SESSION["username"], $_POST["productID"]));
    echo "<meta http-equiv='refresh' content='0'>";
    }

    catch(PDOexception $e) { 
        echo "Update failed: " . $e->getMessage();
        die();
    }


}
}



?>



</body>
</html>
