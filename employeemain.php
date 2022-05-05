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
  background-color: black;
  padding: 10px 10px;
  width: 100%;
  box-shadow: 10px 10px 5px lightblue;
  
}

input[type=text], select, input[type=submit] {
        width: 95%;
        padding: 12px 20px;
        margin: 8px 0;
        margin-left: 2%;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    input[type=submit] {
        color: white;
        background-color: dodgerblue;
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
  float: left;
  color: white;
  font-family: "Audiowide", sans-serif;
}
h1{
    font-family: "Audiowide", sans-serif;
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
  background-color: white;
  
}

.footer{
  background-color: black;
  color: white;
  width:100%;
  padding: 10px 10px;
  text-align: center;
  margin-top: 20px;

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
  <p class = "icon">For Employees</p>
  <a href = "GroupProjectlogin.html"><img class = "icon-right" src = "shoeimage/Logout.png" alt = "Logout"></a>
  </div>
</div>
<?php
//employeemain.ph
include "secrets.php";

try{

    $dsn = "mysql:host=courses;dbname=".$username;
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOexception $except) {
    echo "Connection to database failed: " . $except->getMessage();
}

session_start();
echo"<style> h1{text-align: center;} </style> <h1> Welcome back ".$_SESSION["username"]." to the Employee Portal!";
echo "<h2><b><u> List of products</u></b></h2>";
$rs=$pdo->query("SELECT * FROM INVENTORY");
$rows=$rs->fetchAll(PDO::FETCH_ASSOC);
echo "<table border=1 cellspacing=1>";
echo "<tr> <th>ProductID</th> <th>Product Name</th> <th>Price</th> <th>Quantity</th> \n";
foreach($rows as $row){
    echo"<tr>";
    echo "<td>". $row["productID"]."</td> <td>".$row["productName"]."</td> <td>".$row["price"]."</td> <td>".$row["qty"]."</td>";
    echo"</tr>";
}
echo "</table>";

echo "<form method=\"POST\" >";
    echo "<h3><u>Want to update inventory?</u>\n";

    //Item to update
    echo "<h4>Please select an item to update: </h4>";
    echo "<select name = \"productName\">";
    foreach($rows as $row){
    echo "<option value=".$row["productName"].">".$row["productName"]."</option>";
    }
    echo "</select>";

    //Part of inventory to change
    echo "<h4>Please select what to change: </h4>";
    echo "<select name = \"partChange\">";
    $rs=$pdo->query("SELECT * FROM INVENTORY");
    $rows=$rs->fetchAll(PDO::FETCH_ASSOC);
    echo "<option value=\"productName\"> Product Name </option>";
    echo "<option value=\"price\"> Price </option>";
    echo "<option value=\"qty\"> Quantity </option>";
    echo "</select>";
    
    //amount user wants to update to
    echo"<h4>Please enter amount to change to: </h4>";
    echo"<input type=\"text\" name=\"uamount\">";
    echo "<input type = \"submit\" name = \"purchase\" value=\"Update!\" />";
    echo "</form>";

    if(isset($_POST['productName']))
    {
        $pName=$_POST['productName'];
    }


    if(isset($_POST['uamount']))
    {
        $cAmount=$_POST['uamount'];
    } 

    if(isset($_POST['partChange']))
    {
        $cPart=$_POST['partChange'];
        if($cPart=="productName")
        {
            $sql='UPDATE INVENTORY SET productName = ? WHERE productName = ?';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$cAmount,$pName]);
            if($result)
            {
                $rsp=$pdo->query("SELECT * FROM INVENTORY WHERE productName='$cAmount' ");
                $rows3=$rsp->fetchAll(PDO::FETCH_ASSOC);
                echo "<table border=1 cellspacing=1>";
                echo "<tr> <th>ProductID</th> <th>Product Name</th> <th>Price</th> <th>Quantity</th>\n";
                foreach($rows3 as $row3){
                    echo"<tr>";
                    echo "<td>". $row3["productID"]."</td> <td>".$row3["productName"]."</td> <td>".$row3["price"]."</td> <td>".$row3["qty"]."</td>\n";
                    echo"</tr>";
                }
                echo "</table>";
                echo "UPDATE CONFIRMED!";

            }
        }
        if($cPart=="price")
        {
            $sql='UPDATE INVENTORY SET price = ? WHERE productName = ?';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$cAmount,$pName]);
            if($result)
            {
                $rsp=$pdo->query("SELECT * FROM INVENTORY WHERE productName='$pName' ");
                $rows3=$rsp->fetchAll(PDO::FETCH_ASSOC);
                echo "<table border=1 cellspacing=1>";
                echo "<tr> <th>ProductID</th> <th>Product Name</th> <th>Price</th> <th>Quantity</th>\n";
                foreach($rows3 as $row3){
                    echo"<tr>";
                    echo "<td>". $row3["productID"]."</td> <td>".$row3["productName"]."</td> <td>".$row3["price"]."</td> <td>".$row3["qty"]."</td>\n";
                    echo"</tr>";
                }
                echo "</table>";
                echo "UPDATE CONFIRMED!";

            }
        }

        if($cPart=="qty")
        {
            $sql='UPDATE INVENTORY SET qty = ? WHERE productName = ?';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$cAmount,$pName]);
            if($result)
            {
                $rsp=$pdo->query("SELECT * FROM INVENTORY WHERE productName='$pName' ");
                $rows3=$rsp->fetchAll(PDO::FETCH_ASSOC);
                echo "<table border=1 cellspacing=1>";
                echo "<tr> <th>ProductID</th> <th>Product Name</th> <th>Price</th> <th>Quantity</th>\n";
                foreach($rows3 as $row3){
                    echo"<tr>";
                    echo "<td>". $row3["productID"]."</td> <td>".$row3["productName"]."</td> <td>".$row3["price"]."</td> <td>".$row3["qty"]."</td>\n";
                    echo"</tr>";
                }
                echo "</table>";
                echo "UPDATE CONFIRMED!";

            }
        }
    }

    //display order table
    echo "<h2><b><u> List of orders</u></b></h2>";
    $rs2=$pdo->query("SELECT * FROM ORDERZ");
    $rows2=$rs2->fetchAll(PDO::FETCH_ASSOC);
    echo "<table border=1 cellspacing=1>";
    echo "<tr> <th>OrderID</th> <th>Username</th> <th>Billing Info</th> <th>Shipping Info</th><th>Contact Info</th> <th>Shipping Status</th> <th>Order Notes</th> <th>Order Total</th> </tr>\n";
    foreach($rows2 as $row2){
        echo"<tr>";
        echo "<td>". $row2["orderID"]."</td> <td>".$row2["userName"]."</td> <td>".$row2["billingINFO"]."</td> <td>".$row2["shipINFO"]."</td><td>".$row2["contactINFO"]."</td> <td>".$row2["ship_status"]."</td> <td>".$row2["orderNotes"]."</td> <td>".$row2["orderTotal"]."</td>\n";
        echo"</tr>";
    }
    echo "</table>";
    
    //update orders
    echo "<form  method=\"POST\" >";
        echo "<h3><u>Want to update order status?</u>\n";
    
        //order to update
        echo "<h4>Please select an order ID to update: </h4>";
        echo "<select name = \"orderID\">";
        foreach($rows2 as $row2){
        echo "<option value=".$row2["orderID"].">".$row2["orderID"]."</option>";
        }
        echo "</select>";
    
        //status to change to
        echo "<h4>Please select status to change to: </h4>";
        echo "<select name = \"oStatus\">";
        $rs=$pdo->query("SELECT * FROM INVENTORY");
        $rows=$rs->fetchAll(PDO::FETCH_ASSOC);
        echo "<option value=\"Processing\"> Processing </option>";
        echo "<option value=\"Shipped\"> Shipped </option>";
        echo "<option value=\"Delivered\"> Delivered </option>";
        echo "</select>";
        echo "<input type = \"submit\" name = \"purchase\" value=\"Update!\" />";
        echo "</form>";
    
        if(isset($_POST['orderID']))
        {
            $oID=$_POST['orderID'];
        }
    
        if(isset($_POST['oStatus']))
        {
            $oStatus=$_POST['oStatus'];

            if($oStatus=="Processing")
            {
                $sql='UPDATE ORDERZ SET ship_status = ? WHERE orderID = ?';
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([$oStatus,$oID]);
                if($result)
                {
                    $rso6=$pdo->query("SELECT * FROM ORDERZ WHERE orderID='$oID' ");
                    $rows6=$rso6->fetchAll(PDO::FETCH_ASSOC);
                    echo "<table border=1 cellspacing=1>";
                    echo "<tr> <th>OrderID</th> <th>Username</th> <th>Billing Info</th> <th>Shipping Info</th> <th>Shipping Status </th></tr>";
                    foreach($rows6 as $row6){
                        echo"<tr>";
                        echo "<td>". $row6["orderID"]."</td> <td>".$row6["userName"]."</td> <td>".$row6["billingINFO"]."</td> <td>".$row6["shipINFO"]."</td> <td>".$row6["ship_status"]."</td>\n";
                        echo"</tr>";
                    }
                    echo "</table>";
                    echo "UPDATE CONFIRMED!";
    
                }
            }
            if($oStatus=="Shipped")
            {
                $sql='UPDATE ORDERZ SET ship_status = ? WHERE orderID = ?';
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([$oStatus,$oID]);
                if($result)
                {
                    $rso6=$pdo->query("SELECT * FROM ORDERZ WHERE orderID='$oID' ");
                    $rows6=$rso6->fetchAll(PDO::FETCH_ASSOC);
                    echo "<table border=1 cellspacing=1>";
                    echo "<tr> <th>OrderID</th> <th>Username</th> <th>Billing Info</th> <th>Shipping Info</th> <th>Shipping Status </th></tr>";
                    foreach($rows6 as $row6){
                        echo"<tr>";
                        echo "<td>". $row6["orderID"]."</td> <td>".$row6["userName"]."</td> <td>".$row6["billingINFO"]."</td> <td>".$row6["shipINFO"]."</td> <td>".$row6["ship_status"]."</td>\n";
                        echo"</tr>";
                    }
                    echo "</table>";
                    echo "UPDATE CONFIRMED!";
    
                }
            }
    
            if($oStatus=="Delivered")
            {
                $sql='UPDATE ORDERZ SET ship_status = ? WHERE orderID = ?';
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([$oStatus,$oID]);
                if($result)
                {
                    $rso6=$pdo->query("SELECT * FROM ORDERZ WHERE orderID='$oID' ");
                    $rows6=$rso6->fetchAll(PDO::FETCH_ASSOC);
                    echo "<table border=1 cellspacing=1>";
                    echo "<tr> <th>OrderID</th> <th>Username</th> <th>Billing Info</th> <th>Shipping Info</th> <th>Shipping Status </th></tr>";
                    foreach($rows6 as $row6){
                        echo"<tr>";
                        echo "<td>". $row6["orderID"]."</td> <td>".$row6["userName"]."</td> <td>".$row6["billingINFO"]."</td> <td>".$row6["shipINFO"]."</td> <td>".$row6["ship_status"]."</td>\n";
                        echo"</tr>";
                    }
                    echo "</table>";
                    echo "UPDATE CONFIRMED!";
    
                }
            }
        }
    //update orders
    echo "<form method=\"POST\" >";
    echo "<h3><u>Want to add notes to an order?</u></h3>\n";

    //order to update
    echo "<h4>Please select an order ID to add to: </h4>";
    echo "<select name = \"orderID\">";
    foreach($rows2 as $row2){
    echo "<option value=".$row2["orderID"].">".$row2["orderID"]."</option>";
    }
    echo "</select>";

    //amount user wants to update to
    echo"<h4>Please enter note to add to order :</h4>";
    echo"<input type=\"text\" name=\"addNotes\">";
    echo "<input type = \"submit\" name = \"notes\" value=\"Add to notes!\" />";
    echo "</form>";

    if(isset($_POST['orderID']))
    {
        $oID=$_POST['orderID'];
    }

    if(isset($_POST['addNotes']))
    {
        $addNotes=$_POST['addNotes'];
        $sql='UPDATE ORDERZ SET orderNotes = ? WHERE orderID = ?';
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([$addNotes,$oID]);
                if($result)
                {
                    $rso6=$pdo->query("SELECT * FROM ORDERZ WHERE orderID='$oID' ");
                    $rows6=$rso6->fetchAll(PDO::FETCH_ASSOC);
                    echo "<table border=1 cellspacing=1>";
                    echo "<tr> <th>OrderID</th> <th>Username</th> <th>Billing Info</th> <th>Shipping Info</th><th>Contact Info</th> <th>Shipping Status</th> <th>Order Notes</th> <th>Order Total</th> </tr>\n";
                    foreach($rows6 as $row6){
                        echo"<tr>";
                        echo "<td>". $row6["orderID"]."</td> <td>".$row6["userName"]."</td> <td>".$row6["billingINFO"]."</td> <td>".$row6["shipINFO"]."</td><td>".$row6["contactINFO"]."</td> <td>".$row6["ship_status"]."</td> <td>".$row6["orderNotes"]."</td> <td>".$row6["orderTotal"]."</td>\n";
                        echo"</tr>";
                    }
                    
                    echo "</table>";
                    echo "Note added to order ".$oID."!";
                }
    }

?>

<div class = "footer">
  <p>Shoe Circus is a project made by Dominic Brooks, Jacob Diep, Jabari Cox, Dhruvit Patel, and Logan Misevich</p>

</div>

</body></html>