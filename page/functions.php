<?php
include "page/DB.php";
function makeTable($query, $coloured = null){
    try {
        $db = new DB();
        $stmt = $db->pdo->prepare($query);
        $stmt->execute();
        //tabelle mit 'dynmaischen Spaltenbezeichnung' mittles meta-Daten
        $meta = array();
        echo '<table class="table">
          <tr>';
        $colCount = $stmt->columnCount();
        for ($i = 0; $i < $colCount; $i++){
            $meta[] = $stmt->getColumnMeta($i);
            echo '<th>'.$meta[$i]['name'].'</th>';
        }
        echo '</tr>';
        while ($row = $stmt->fetch(PDO::FETCH_NUM)){
            if ($coloured != null && $row[1] == $coloured) {
                echo "<tr class='table-success'>";
            }else{
                echo '<tr>';
            }
            foreach ($row as $r) {
                echo '<td>'.$r.'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    } catch (Exception $e){
        echo 'Error - Tabelle Adressem: '.$e->getMessage().'; '.$e->getCode().'<br>';
    }
}