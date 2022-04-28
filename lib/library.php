<?php
function print_table(array &$rows){
    echo "        <table>\n";
    echo "            <tr>\n";
    foreach(array_keys($rows[0]) as $heading){
        echo "                <td><strong>$heading<strong></td>\n";
    }
    echo "            </tr>\n";
    foreach($rows as $row){
        echo "            <tr>\n";
        foreach($row as $col) {
            echo "                <td>$col</td>\n";
        }
        echo "            </tr>\n";
    }
    echo "            </tr>\n";
    echo "        </table>\n";
}
?>
