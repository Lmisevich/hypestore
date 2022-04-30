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

.itempic{
    display:block;
    margin-top: 5%;
    margin-left: auto;
    margin-right: auto;
    width: 300px;
    height: 300px;

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

select, input[type=submit] {
        width: 95%;
        padding: 12px 20px;
        margin: 8px 0;
        margin-left: 2%;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
input[type=submit] {

    background-color: dodgerblue;

}    
h1{
  font-family: "Audiowide", sans-serif;
}

h2{
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
    <a href="shoppingcart.php"><img class = "icon-right" src ="shoeimage/ShoppingCart.png" alt = "Shopping Cart" ></a>
  </div>
</div>

<?php

    session_start();

    echo "<h1>Hi, ". $_SESSION["username"]."!</h1>";
    include ("login.php");
    try{

        $dsn = "mysql:host=courses;dbname=z1867741";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOexception $except) {
        echo "Connection to database failed: " . $except->getMessage();
    }

    echo "<h2>" . $_GET["productName"]. "</h2>";
    echo '<img class = "itempic" src = "shoeimage/'. $_GET["productName"].'.png" alt= "Product Image">';

    $rs = $pdo->prepare ("SELECT * FROM INVENTORY WHERE productName = ?;");
    $rs->execute(array($_GET["productName"]));
    $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
    
    if($rows)
    {
        echo "<p>Price: $". $rows[0]["price"]."</p>";
        echo '<form method="POST">';
        echo '<label for= "quantity"> Quantity (Limit 2 per order): </label>
        <select name = "quantity" id="quantity">
        <option value = "1"> 1 </option>
        <option value = "2"> 2 </option>
        </select><br>
        <input type = "hidden" id="productID" name="productID" value ="' . $rows[0]["productID"]. '">
        <input type = "submit" name = "Add to Cart" value = "Add to Cart">
        </form>';
    }

    if($_POST)
    {
        $rs = $pdo->prepare ("INSERT INTO SHOPPING_CART VALUES ( ?, ?, ?);");
        $rs->execute(array($_SESSION["username"], $_POST["productID"], $_POST["quantity"]));

        if($rs)
        {
            echo "Item added to shopping cart!!!";
        }
    }







?>

</body>
</html>