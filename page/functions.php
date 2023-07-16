<?php
require_once "page/DB.php";
function makeTable($query, $valuearray){
    try {
        $db = new DB();
        $stmt = $db->pdo->prepare($query);
        $stmt->execute($valuearray);
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
            echo '<tr>';
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