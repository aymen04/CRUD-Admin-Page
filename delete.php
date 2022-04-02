<?php

    function delete($value, $table, $id) {

$dbh = new PDO('mysql:host=localhost:8889;dbname=PHPPerso', 'root', 'root');

    try {
        $stmt = $dbh->prepare("DELETE FROM `$table` WHERE $id = :id");
        $stmt->bindValue(':id', $value, PDO::PARAM_INT);
        $stmt->execute();

    } 

    catch(PDOException $e) {
        echo $e->getMessage();
        
    }
}