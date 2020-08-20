<?php
    //include_once "session.php";
    require("db.php");
    $brand=$_POST['brand'];
    $model=$_POST['model'];

    if(!empty($brand)&&!empty($model)){
        $sql_check_brand="SELECT brands.brand FROM brands WHERE brands.brand = ?";
        $stmt = $pdo->prepare($sql_check_brand);
        $stmt->execute([$brand]);
        // echo $stmt->rowCount();
        if ($stmt->rowCount() > 0) {
            $sql_check_model="SELECT models.model FROM models WHERE (models.model LIKE ? AND models.id_brands = (SELECT brands.id_brands FROM brands WHERE brands.brand LIKE ?))";
            $stmt = $pdo->prepare($sql_check_model);
            $stmt->execute([$model,$brand]);
            if($stmt->rowCount() > 0){
                header("Location: add_model.php?err=exists");
                die();
            }else{
                $sql_insert_model = "INSERT INTO `models`(`model`, `id_brands`) VALUES (?,(SELECT brands.id_brands FROM brands WHERE brands.brand LIKE ?))"; 
                $stmt = $pdo->prepare($sql_insert_model);
                $stmt->execute([$model,$brand]);
                header("Location: add_model.php?status=success");
                die();
            }
             
        } else {
            header("Location: add_model.php?err=exists");
            die();
        }
    }
    else {
        header("Location: add_model.php");
        die();
    }
    


?>