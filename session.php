<?php

    session_start();

    // $allow_url = ['/avtonet/login.php','/avtonet/login_user.php','/avtonet/registration.php','/avtonet/user_insert.php'];

    // if (!isset($_SESSION['user_id'])&&!in_array($_SERVER['REQUEST_URI'],$allow_url)) {
    //     header("Location: login.php"); 
    //     die();
    // }

    function is_admin() {
        /*require "db.php";
        $query = "SELECT * FROM users WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();

        if ($user['admin']==1) {
            return true;
        } 
        else {
            return false;
        }*/

        if (isset($_SESSION['admin']) && ($_SESSION['admin'] == 1)) {
            return true;
        } 
        else {
            return false;
        }
    }

    function adminOnly() {
        if (!is_admin()) {
            header("Location: index.php");
            die();
        }
    }

    /**
    
    */

    /*
    Funkcija vrača vse id oseb, ki so všeč userju s podanim $user_id
    */
   
    /*
    ALi sta osebi match
    */
  
    function get_user_data($id) {
        require "db.php";
        $query = "SELECT * FROM users WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

?>