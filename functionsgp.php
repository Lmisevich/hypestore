<?php

function make_table1($rows){


    $count = 0;
    $vals = 0;

    //print_r($rows);
    echo "<tr>";
    while($vals != sizeof($rows)){
     
            echo '<td><a href="itemdesc.php?productName='.$rows[$vals]["productName"].'"><img src = "shoeimage/'.$rows[$vals]["productID"].'.png" alt="Shoe" style="width:200px;height:200px;"><p>'.$rows[$vals]["productName"].'</p></a></td>';

            $vals = $vals + 1;
            $count = $count + 1;

            if($count == 5)
            {
                echo "</tr>";
                echo "<tr>";

                $count = 0;
            }
        }
        echo "</tr>";




}

function make_table2($rows){

    echo "<table border=1 cellspacing=1>";

    foreach ($rows[0] as $key => $title){
        echo "<th>$key</th>";
    }
    
    foreach($rows as $row){
        echo "<tr>";
        foreach($row as $key => $thing){

            echo "<td>$thing</td>";
        }
        echo "</tr>";
    }

    echo "</table>";


}

function shopping_cart($rows)
{
    $vals = 0;
    while ($vals != sizeof($rows))
    {
        echo '<img src = "' . $rows[$vals]["productName"] . '.png" alt = "Item photo"><br>';
        echo $rows[$vals]["productName"];
        echo $rows[$vals]["pr"];
        echo $rows[$vals]["orderQTY"];
    }
}


?>