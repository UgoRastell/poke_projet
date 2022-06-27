<?php 
try {
    $db = new PDO('mysql:host=localhost;dbname=bdd_card_poke','root','');
    $db->exec('SET NAMES "UTF8"');
}catch (PDOException $e){
    echo 'Erreur : ' . $e->getMessage();
    die();
}
?>