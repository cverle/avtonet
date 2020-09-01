<!DOCTYPE html>
<html lang="en">

<head>
  <?php require('css-js.php'); ?>
  <style>
    .parallax {
      /* The image used */
      background-image: url('./mercedes.jpg');
      /* Create the parallax scrolling effect */
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      /* -webkit-filter: blur(5px);
      -moz-filter: blur(5px);
      -o-filter: blur(5px);
      -ms-filter: blur(5px);
      filter: blur(5px); */
    }

    .no-blur {
      -webkit-filter: blur(0) !important;
      -moz-filter: blur(0) !important;
      -o-filter: blur(0) !important;
      -ms-filter: blur(0) !important;
      filter: blur(0) !important;
    }
  </style>
</head>

<body>

  <?php include('header.php'); ?>

  <section class="parallax py-5">
    <div class="container-fluid no-blur" style="padding-top:10%;">
      <div class="container" style="background-color: white; -webkit-box-shadow: 0px 0px 10px 3px rgba(186,186,186,0.9);
-moz-box-shadow: 0px 0px 10px 3px rgba(186,186,186,0.9);
box-shadow: 0px 0px 10px 3px rgba(186,186,186,0.9);">
        <div class="d-flex justify-content-center no-blur">
          <h1>Cool cars</h1>
        </div>
        <hr />
        <div class="d-flex justify-content-center no-blur">
          <?php
            $sql_select_cars = "SELECT
                                  cars.*,
                                  pictures.url,
                                  brands.brand,
                                  models.model,
                                  fuel.fuel_type
                              FROM
                                  cars
                              INNER JOIN pictures ON pictures.id_cars = cars.id_cars
                              INNER JOIN models ON models.id_models = cars.id_models
                              INNER JOIN brands ON brands.id_brands = models.id_brands
                              INNER JOIN fuel ON fuel.id_fuel = cars.id_fuel
                              ORDER BY RAND()
                              LIMIT 3;";
            $stmt_cars = $pdo->query($sql_select_cars);
            while($cars=$stmt_cars->fetch()){
              $id_selected_car = $cars['id_cars'];
              echo'
                <div class="card" style="width: 18rem; margin:4px;">
                  <img class="card-img-top" src="' . $cars['url'] . '" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">' . $cars['brand'] . ', ' . $cars['model'] . '</h5>
                    <p class="card-text">' . $cars['price'] . ' &#8381;<br />
                        Registered year: ' . $cars['year_of_registration'] . '<br />
                        Fuel type: ' . $cars['fuel_type'] . '<br />
                        Gear shift type: ' . $cars['gear_shifts'] . '</p>
                  </div>
                </div>
              ';
            }
          ?>
        </div>
      </div>
    </div>
  </section>
  <?php include('footer.php'); ?>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

</body>

</html>