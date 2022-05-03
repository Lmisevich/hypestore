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
  font-family: Arial, Helvetica, sans-serif;
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
  <a href="orders.php"><img class = "icon-right" src ="shoeimage/OrderTracker.png" alt = "Orders" ></a>
  <a href="shoppingcart2.php"><img class = "icon-right" src ="shoeimage/ShoppingCart.png" alt = "Shopping Cart" ></a>
  </div>
</div>

<?php
//orders.php
include "secrets.php";
session_start();
$_SESSION["username"] = $_POST["username"];
$user = $_SESSION["username"];

try{

    $dsn = "mysql:host=courses;dbname=z1867741";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOexception $except) {
    echo "Connection to database failed: ".$except->getMessage();
}

// print order, product, quantity, and status
echo "<h2><b><u>Order Status:</u></b>";
$os=$pdo->query("SELECT * FROM ORDERZ WHERE userName = '$user'");
$rows=$os->fetchAll(PDO::FETCH_ASSOC);
echo "<table border=1 cellspacing=1> <tr> <th>Order #</th> <th>Product</th> <th>Quantity</th> <th>Status</th> ";
foreach($rows as $row)
{
	$id = $row["orderID"];
	$cr=$pdo->query("SELECT * FROM ORDER_CONTENTS WHERE orderID = '$id'");
	$content_rows=$cr->fetchAll(PDO::FETCH_ASSOC);
	foreach($content_rows as $c_row)
	{
		$pid = $c_row["productID"];
		$ir=$pdo->query("SELECT productName FROM INVENTORY WHERE productID = '$pid'");
		$p_rows=$ir->fetchAll(PDO::FETCH_ASSOC);
		foreach($p_rows as $p_row)
			echo "<tr> <td>".$row["orderID"]."</td> <td>".$p_row["productName"]."</td> <td>".$c_row["orderQTY"]."</td> <td>".$row["ship_status"]."</td> </tr>";
	}	
}
echo "</table>";

// print order cost, and total cost at bottom
echo "<h2><b><u>Order Cost:</u></b>";
echo "<table border=1 cellspacing=1> <tr> <th>Order #</th> <th>Cost</th>  ";
$totalCost = 0;
foreach($rows as $row)
{
	echo "<tr> <td>".$row["orderID"]."</td> <td>$".$row["orderTotal"]."</td> </tr>";
	$totalCost = $totalCost + $row["orderTotal"];
}
echo "<tr> <td>total</td> <td>$".$totalCost."</td> </tr>";
echo "</table>";

// print order notes
echo "<h2><b><u>Order Notes:</u></b>";
echo "<table border=1 cellspacing=1> <tr> <th>Order #</th> <th>Notes</th>  ";
foreach($rows as $row)
{
	echo "<tr> <td>".$row["orderID"]."</td> <td>".$row["orderNotes"]."</td> </tr>";
}
echo "</table>";

?>    

</body>
</html>
