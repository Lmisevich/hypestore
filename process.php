<?php

//echo "Hi it went through";
//echo "<br>";

include("login.php");

try{

    $dsn = "mysql:host=courses;dbname=z1867741";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOexception $except) {
    echo "Connection to database failed: " . $except->getMessage();
}

//print_r($_POST);

session_start();

$_SESSION["username"] = $_POST["username"];

$rs = $pdo->prepare("SELECT * FROM USERZ WHERE userName = ?;");
$rs->execute(array($_POST["username"]));
$rows = $rs->fetchAll(PDO::FETCH_ASSOC);

if ($rows)
{

    //echo "rows is here";
    //echo $rows[0]["isEmployee"];

if($rows[0]["isEmployee"] == 1)
{
    header("Location: employeemain.php");
    die();
}

else
{
    header("Location: customermain.php");
    die();
}

}

else{
    
echo '<!DOCTYPE html>
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



.icon-right{
  width: 50px;
  height: 50px;
  float: right;
  margin-right: 10px;
  
}
.login{
    border: 10px groove dodgerblue;
    background-color:lightgray;
    border-radius: 5px;
    font-family: "Audiowide", sans-serif;
    font-size: 20px;
    margin: auto;
    margin-top: 10%;
    margin-bottom: 5%;
    padding-top: 10%;
    padding-bottom: 10%;
    width: 50%;
    /*padding-left: 19%;
    padding-right: 1px; */
}

.login label{
    text-align: left;
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
  border: 3px solid dodgerblue;
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
    <img class = "dart" src ="shoeimage/CompanyLogo.png" alt = "Company Logo" >

</div>';
    
    echo "<p>Username not found\n";
    echo '<a href = "GroupProjectlogin.html">Click here for Login page</a><br>';
    echo '<a href = "createaccount.php">Click here to Create Account</a></p>';
echo '</body>';
echo '</html>';
}



?>
