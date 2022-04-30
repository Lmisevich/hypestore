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

</div>
<div class= "login">
    <form method = "POST">
    <label for = "username">Enter your Username</label><br>
    <input type = "text" name= "username" placeholder="Username"/><br>
    <label for= "employeecheck"> Are you an employee </label><br>
    <select name = "employeecheck" id="employeecheck">
    <option value = "1"> Yes </option>
    <option value = "0"> No </option>
    </select><br>
    <input type = "submit" name = "Login">
    </form>
</div> 
<?php
include("login.php");
include("functionsgp.php");

try{

   $dsn = "mysql:host=courses;dbname=z1867741";
   $pdo = new PDO($dsn, $username, $password);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOexception $except) {
   echo "Connection to database failed: " . $except->getMessage();
}

if($_POST)
{


    if ( $_POST["employeecheck"]== "Yes")
    {
        $_POST["employee"] = true;

    }

    else if ($_POST["employeecheck"] == "No"){
        $_POST["employee"] = false;

    }

    $count = 0;

    try{
        $rs = $pdo->prepare("INSERT INTO USERZ VALUES (? , ?);");
        $rs->execute(array($_POST["username"], $_POST["employeecheck"]));
    }

    catch(PDOexception $except) {
        echo "Insertion failed: Username Already exists.". $except->getMessage();
        echo '<a href = "createaccount.php">Click here and try again</a>';
        $count = 1;
    }
    


    if ($count != 1){
        $rs = $pdo->prepare("SELECT * FROM USERZ WHERE userName = ?;");
        $rs->execute (array($_POST["username"]));
    
        if($rs->rowCount()> 0)
        {
            echo "Account creation succesful!! Click below to log in ";
            echo '<form action = "process.php" method= "POST">';
            echo '<input type="hidden" id="username" name="username" value="'.$_POST["username"].'">';
            echo '<input type = "Submit" value = "Log In">';
            echo '</form>';
        }

        else{
            echo "Insert failed";
        }
    }
    
}


?>   
</body>
</html>
