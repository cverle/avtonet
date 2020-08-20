<?php
    //include_once "session.php";
    require("db.php");
    $brand=$_POST['brand'];

    if(!empty($brand)){
        $sql_check_brand="SELECT brands.brand FROM brands WHERE brands.brand = ?";
        $stmt = $pdo->prepare($sql_check_brand);
        $stmt->execute([$brand]);
        echo $stmt->rowCount();
        if ($stmt->rowCount() > 0) { 
            header("Location: add_brand.php?err=exists");
            die();
        } else {
            $sql_insert_brand = "INSERT INTO `brands`(`brand`) VALUES (?)"; 
            $stmt = $pdo->prepare($sql_insert_brand);
            $stmt->execute([$brand]);
            header("Location: add_brand.php?status=success");
            die();
        }
    }
    else {
        header("Location: add_brand.php");
        die();
    }
    


?>