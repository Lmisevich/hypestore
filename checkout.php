<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoecirus.com</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  margin:0;
  font-family: Arial;
  font-size: 17px;

}

.header {
  overflow: hidden;
  background-color: #1E90FF;
  padding: 10px 10px;
  width: 100%;
  box-shadow: 10px 10px 5px lightblue;
  
}

.daform{
  padding: 8px;
}

.footer{
  background-color: black;
  color: white;
  width:100%;
  padding: 10px 10px;
  margin-bottom: 0px;
  margin-top: 20px;
  text-align: center;
  font-family: Arial, Helvetica, sans-serif;
  

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
  font-size: 25px;
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
  padding-top: 20px;
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


* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: dodgerblue;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: dodgerblue;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
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

<div class ="daform">
<?php



session_start();
include("secrets.php");

try { 
    $dsn = "mysql:host=courses;dbname=".$username;
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOexception $e){ 
    
    echo "Connection to database failed: " . $e->getMessage();
}


echo '<h2>Checkout Form</h2>

<div class="row">
  <div class="col-75">
    <div class="container">
      <form method = "POST">';
      $rs = $pdo->prepare("SELECT * FROM INVENTORY, SHOPPING_CART WHERE userName = ? AND INVENTORY.productID = SHOPPING_CART.productID");
      $rs->execute(array($_SESSION["username"]));
      $rows= $rs-> fetchAll(PDO::FETCH_ASSOC);
      $price = 0;
      for($count = 0; $count != sizeof($rows); ++$count)
        {
            $price += $rows[$count]["price"] * $rows[$count]["orderQTY"];
            echo '<input type ="hidden" name="productID'.$count.'" value="'.$rows[$count]["productID"].'"/>';
            echo '<input type ="hidden" name="productQTY'.$count.'" value="'.$rows[$count]["orderQTY"].'"/>';
        }

        echo'<input type="hidden" name="price" value="'.$price.'"/>';
        echo '<div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="phone"><i class="fa fa-phone"></i> Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="1234567890">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="shipINFO" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="billingINFO" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Place Order" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">';

    echo '<h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>'. sizeof($rows).'</b></span></h4>';
  $count = 0;

  $item_price = 0;
  while($count != sizeof($rows))
  {

    $item_price = $rows[$count]["price"] * $rows[$count]["orderQTY"];

    echo '<p>'. $rows[$count]["productName"]. ' x ' . $rows[$count]["orderQTY"].'<span class="price">$'. $item_price. '</span></p>';
    $count++;
  }

  echo'<hr>
  <p>Total <span class="price" style="color:black"><b>$'. $price .'</b></span></p>
  
</div>
</div>
</div>

</div>';





if($_POST)
{

$rs =$pdo->prepare('INSERT INTO ORDERZ (userName, billingINFO, shipINFO, contactINFO, orderTotal) VALUES (?,?,?,?,?)');
$rs->execute(array($_SESSION["username"],$_POST["billingINFO"],$_POST["shipINFO"], $_POST["phone"], $_POST["price"]));
$product_size = (sizeof($_POST) - 13 ) / 2;
$rs = $pdo->prepare("SELECT * FROM ORDERZ WHERE userName = ? ");
$rs->execute(array($_SESSION["username"]));
$rows= $rs-> fetchAll(PDO::FETCH_ASSOC);
$last = sizeof($rows) - 1;
$_POST["orderID"] = $rows[$last]["orderID"];
for($counter = 0; $counter!= $product_size; ++$counter)
{
$rs =$pdo->prepare('INSERT INTO ORDER_CONTENTS VALUES (?,?,?)');
$rs->execute(array($_POST["orderID"], $_POST["productID".$counter], $_POST["productQTY".$counter]));
}
for($counter = 0; $counter!= $product_size; ++$counter)
{
$rs = $pdo->prepare('UPDATE INVENTORY SET qty = qty - ? WHERE productID = ?' );
$rs->execute(array($_POST["productQTY".$counter], $_POST["productID".$counter]));
}

$rs =$pdo->prepare('DELETE FROM SHOPPING_CART WHERE userName = ?');
$rs->execute(array($_SESSION["username"]));

echo 'Order Placed Successfully!!<a href ="order_tracker.php">Click here to track your order</a>';

}


echo '<div class ="footer">
  <p>Shoe Circus is a project made by Dominic Brooks, Jacob Diep, Jabari Cox, Dhruvit Patel, and Logan Misevich</p>
</div>
</body>
</html>';


?>