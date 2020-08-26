<?php
    require('db.php');
    // require('session.php');

    $brand_id = $_GET['brand_id'];
    $select_models_for_brand = "SELECT models.id_models AS `id_model`, models.model AS `model` FROM models WHERE models.id_brands = ?";

    $stmt = $pdo->prepare($select_models_for_brand);
    $stmt->execute([$brand_id]); 
    $data_array = array();
    while($data_selected=$stmt->fetch()){
        $selected_data_array = [
            'text' => strval($data_selected['model']),
            'value' => $data_selected['id_model']
        ];
        array_push($data_array,$selected_data_array);
    }
    //respond with array of all models
    echo json_encode($data_array);
?>