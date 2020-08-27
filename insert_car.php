<?php
    include_once "db.php";
    include_once "session.php";

    $gear_shift = $_POST['gear_shift'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $fuel = $_POST['fuel'];
    $yearRegistration = $_POST['yearRegistration'];
    $engine="nevem";
    $user_id = $_SESSION['user_id'];
    // $imageOfCar = $_POST['imageOfCar'];
    $price = $_POST['price'];

    if (!empty($brand) && !empty($model) && !empty($fuel) && !empty($yearRegistration) && !empty($price)) {
        if($_FILES['imageOfCar']['tmp_name']!=''){
            $file_before = uniqid() . "-" . time();
            $filename = hash_hmac('sha512', $file_before, 'thisisahash');
            $extension = pathinfo($_FILES["imageOfCar"]["name"], PATHINFO_EXTENSION);
            $basename = $filename . "." . $extension;
            $local_dir = "./uploads/";
            $local_file = $local_dir . $basename;

            if (move_uploaded_file($_FILES["imageOfCar"]["tmp_name"], $local_file)) {
                $file_submited = strval($local_file);
                $sql_insert_car = "INSERT INTO cars(
                                        cars.gear_shifts,
                                        cars.year_of_registration,
                                        cars.engine,
                                        cars.price,
                                        cars.id_users,
                                        cars.id_fuel,
                                        cars.id_models
                                    )
                                    VALUES(?, ?, ?, ?, ?, ?, ?);";
                $stmt=$pdo->prepare($sql_insert_car);
                $stmt->execute([$gear_shift,$yearRegistration,$engine,$price,$user_id,$fuel,$model]);
                $last_car_id = $pdo->lastInsertId();
                $sql_insert_pic = "INSERT INTO pictures (pictures.url, pictures.id_cars) VALUES (?,?);";
                $stmt=$pdo->prepare($sql_insert_pic);
                $stmt->execute([$file_submited,$last_car_id]);
                header('location: ./add_car.php?status=success');
            } else {
                header('location: ./add_car.php?status=err_file');
            }
        }
        // 
    }else{
        header('location: ./add_car.php?status=empty_data');
    }

?>