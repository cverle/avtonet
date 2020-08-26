<?php
    include_once "db.php";

    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $fuel = $_POST['fuel'];
    $yearRegistration = $_POST['yearRegistration'];
    // $imageOfCar = $_POST['imageOfCar'];
    $price = $_POST['price'];

    if (!empty($brand) && !empty($model) && !empty($fuel) && !empty($yearRegistration) && !empty($price)) {
        if($_FILES['imageOfCar']['tmp_name']!=''){
            $file_before = uniqid() . "-" . time();
            $filename = hash_hmac('sha512', $file_before, '5367556B58703273357638792F423F4528482B4D6251655468576D597133743677397A24432646294A404E635266556A586E327234753778214125442A472D4B');
            $extension = pathinfo($_FILES["imageOfCar"]["name"], PATHINFO_EXTENSION);
            $basename = $filename . "." . $extension;
            $local_dir = "./uploads/";
            $local_file = $local_dir . $basename;

            if (move_uploaded_file($_FILES["imageOfCar"]["tmp_name"], $local_file)) {
                $file_submited = strval("'" . $local_file . "'");
            } else {
                //header('location: ../../challenge_create.php?status=file-err');
            }
        }
        // 
    }

?>