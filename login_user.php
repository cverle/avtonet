<?php
include_once "session.php";


include_once "db.php";

$email = $_POST['email'];
$pass = $_POST['password'];

if (!empty($email) && !empty($pass)) {
    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);        

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        if (password_verify($pass,$user['pass'])) {
            //vse je pravilno
            $_SESSION['user_id'] = $user['id_users'];
            $_SESSION['full_name'] = $user['first_name'].' '.$user['last_name'];
            $_SESSION['email'] = $user['email'];
    
            header("Location: index.php");
            die();
        }
    }
}

header("Location: login.php?err=incorrect");
die();

?>