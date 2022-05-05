<?php
declare(strict_types = 1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process</title>
</head>
<body>
    <h1>Process</h1>
<?php
//process.php
//echo "Hi it went through";
//echo "<br>";
include("login.php");
try{
    $dsn = "mysql:host=courses;dbname=z1867741";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOexception $except) {
    echo "Connection to database failed: " . $except->getMessage();
}
//print_r($_POST);
$_SESSION["username"] = $_POST["username"];
$rs = $pdo->prepare("SELECT * FROM USERZ WHERE userName = ?;");
$rs->execute(array($_POST["username"]));
$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
if ($rows){
    //echo "rows is here";
    //echo $rows[0]["isEmployee"];
    if($rows[0]["isEmployee"] == 1)
    {
        header("Location: employeemain.php");
        die();
    }else{
        header("Location: customermain.php");
        die();
    }
}else{
    echo "Redirect didnt work";
}
?>