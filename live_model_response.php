<?php
    require('db.php');
    require('session.php');

    $brand_id = $_POST['brand_id'];
    $select_models_for_brand = "SELECT models.model AS `model` FROM models WHERE models.id_brands = ?";

    $stmt = $pdo->prepare($select_models_for_brand);
    $stmt->execute([$brand_id]); 

    //respond with array of all models
?>