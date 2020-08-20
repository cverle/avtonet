<?php
    //include_once "session.php";
    require("db.php");
    $f_name=$_POST['first_name'];
    $l_name=$_POST['last_name'];
    $email=$_POST['email'];
    $pass=$_POST['password'];

    if(!empty($f_name)&&!empty($l_name)&&!empty($email)&&!empty($pass)){
        $sql_check_email="SELECT users.id_users FROM users WHERE users.email = ?";
        $stmt = $pdo->prepare($sql_check_email);
        $stmt->execute([$email]);
        echo $stmt->rowCount();
        if ($stmt->rowCount() > 0) { 
            header("Location: registration.php?err=exists");
            die();
        } else {
             
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql_insert_user = "INSERT INTO users (first_name, last_name, email, pass) VALUES (?,?,?,?)"; 
            $stmt = $pdo->prepare($sql_insert_user);
            $stmt->execute([$f_name,$l_name,$email,$pass_hash]);
            header("Location: login.php");
            die();
        }

    }
    else {
        header("Location: registration.php");
        die();
    }
    


?>