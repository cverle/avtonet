<?php 
require('db.php');
require('session.php');
?>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an text logo -->
        <h1 class="text-light"><a href="#header"><span>Not yet Avto.net</span></a></h1>
        <a href="index.php" class="scrollto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="avto.php">Cars</a></li>
          <!-- <li><a href="moto.php">Moto</a></li>
          <li><a href="gospodarska.php">Gospodarska</a></li> -->
          <li><a href="#contact">Contact Us</a></li>
        
          <?php 
            if(isset($_SESSION['user_id'])){
              echo'<li><a href="profile.php">'.$_SESSION['full_name'].'</a></li><li><a href="logout.php">Logout</a></li>';
            }else{
              echo'
              <li><a href="login.php">Login</a></li>
              <li><a href="registration.php">Registration</a></li>
              ';
            }
          ?>
          
        </ul>
      </nav><!-- .main-nav -->

    </div>
  </header><!-- #header -->