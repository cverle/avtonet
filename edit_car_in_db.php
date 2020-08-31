<?php
    include_once "db.php";
    include_once "session.php";
    $carID = $_POST['carID'];
    $gear_shift = $_POST['gear_shift'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $fuel = $_POST['fuel'];
    $yearRegistration = $_POST['yearRegistration'];
    $engine="nevem";
    $user_id = $_SESSION['user_id'];
    // $imageOfCar = $_POST['imageOfCar'];
    $price = $_POST['price'];

    if(!isset($_SESSION['user_id']) && $_SESSION['user_id'] == ''){
        header('location: login.php');
        die();
    }

    if (!empty($brand) && !empty($model) && !empty($fuel) && !empty($yearRegistration) && !empty($price)) {
        if($_FILES['imageOfCar']['tmp_name']!=''){

            $select_pic = "SELECT pictures.url FROM pictures WHERE pictures.id_cars = ?";
            $stmt=$pdo->prepare($select_pic);
            $stmt->execute([$carID]);

            if($stmt->rowCount() > 0){
                $pic=$stmt->fetch();
                $filePath = $pic['url'];

                // check if path to image in database exists
                if (file_exists($filePath)) {
                    // delete image
                    unlink($filePath);

                    $file_before = uniqid() . "-" . time();
                    $filename = hash_hmac('sha512', $file_before, 'thisisahash');
                    $extension = pathinfo($_FILES["imageOfCar"]["name"], PATHINFO_EXTENSION);
                    $basename = $filename . "." . $extension;
                    $local_dir = "./uploads/";
                    $local_file = $local_dir . $basename;

                    if (move_uploaded_file($_FILES["imageOfCar"]["tmp_name"], $local_file)) {
                        $file_submited = strval($local_file);
                        
                        $sql_update_pic = "UPDATE
                                                pictures
                                            SET
                                                pictures.url = ?
                                            WHERE
                                                pictures.id_cars = ?;";
                        $stmt=$pdo->prepare($sql_update_pic);
                        $stmt->execute([$file_submited,$carID]);
                        // header('location: ./add_car.php?status=success');
                    } else {
                        // header('location: ./add_car.php?status=err_file');
                    }
                }
            }
        }
        // 
    }else{
        // header('location: ./add_car.php?status=empty_data');
    }

    $sql_update_car = "UPDATE
                            cars
                        SET
                            cars.gear_shifts = ?,
                            cars.year_of_registration = ?,
                            cars.price = ?,
                            cars.id_fuel = ?,
                            cars.id_models = ?
                        WHERE
                            cars.id_cars = ?;";
    $stmt=$pdo->prepare($sql_update_car);
    $stmt->execute([$gear_shift,$yearRegistration,$price,$fuel,$model,$carID]);

    header('location: ./avto.php?status=success');
?>