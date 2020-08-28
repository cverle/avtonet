<?php
    require('db.php');
    // require('session.php');

    $car_id = $_GET['car_id'];
    $select_car = "SELECT cars.id_cars FROM `cars` WHERE cars.id_cars = ?";
    $select_pic = "SELECT pictures.url FROM pictures WHERE pictures.id_cars = ?";
    $delete_pic = "DELETE FROM `pictures` WHERE pictures.id_cars = ?";
    $delete_car = "DELETE FROM `cars` WHERE cars.id_cars = ?";

    // check for car with that id
    $stmt=$pdo->prepare($select_car);
    $stmt->execute([$car_id]);
    if($stmt->rowCount() >0){

        // check for image with car id
        $stmt=$pdo->prepare($select_pic);
        $stmt->execute([$car_id]);

        if($stmt->rowCount() >0){
            $pic=$stmt->fetch();
            $filePath = $pic['url'];

            // check if path to image in database exists
            if (file_exists($filePath)) {
                // delete image
                unlink($filePath);

                // delete image in database
                $stmt=$pdo->prepare($delete_pic);
                $stmt->execute([$car_id]);

                $stmt=$pdo->prepare($delete_car);
                $stmt->execute([$car_id]);
                return 'Deleted car';
            }else{
                // boop no delete image
                return 'Image not deleted';
            }
        }else{
            // boop image
            return 'No image available';
        }
    }else{
        // boop car
        return 'No car available';
    }

    return 'OOF megga ErroR';
?>