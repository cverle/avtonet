<!DOCTYPE html>
<html lang="en">

<head>
  <?php require('css-js.php'); ?>
</head>

<body>

  <?php include('header.php'); ?>
  <section class="py-5">
    <div class="container-fluid" style="padding-top:10%;">
      <div class="container">
        <div class="d-flex justify-content-center">
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
                            ORDER BY
                                cars.year_of_registration ASC
                            LIMIT 3;";
          $stmt_cars = $pdo->query($sql_select_cars);
          while($cars=$stmt_cars->fetch()){
            $id_selected_car = $cars['id_cars'];
            echo'
              <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="' . $cars['url'] . '" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">' . $cars['brand'] . ', ' . $cars['model'] . '</h5>
                  <p class="card-text">' . $cars['price'] . '&#8381;<br />
                      Registered year: ' . $cars['year_of_registration'] . '<br />
                      Fuel type: ' . $cars['fuel_type'] . '<br />
                      Gear shift type: ' . $cars['gear_shifts'] . '</p>
                      <hr />
                      <div class="row">
                        <div class="col"><form action="edit_car.php" method="POST"><input type="hidden" name="carID" value="' . $id_selected_car . '"><button type="submit" class="btn btn-success" style="float: right;">Edit</button></form></div>
                        <div class="col"><div class="btn btn-danger" style="float: left;" onclick="deleteCar(' . $id_selected_car . ')">Delete</div></div>
                      </div>
                </div>
              </div>
            ';
          }
        ?>

        </div>
        <hr />
        <div class="d-flex justify-content-center">
          <a href="add_car.php" class="btn btn-success">Add car</a>
        </div>
      </div>
      <br />
      <div class="container">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Brand <a href="add_brand.php" class="btn btn-success">+</a></th>
              <th scope="col">Models <a href="add_model.php" class="btn btn-success">+</a></th>
            </tr>
          </thead>
          <tbody>
            <?php
              $select_brand="SELECT brands.brand AS `brand`, brands.id_brands AS `brand_id` FROM `brands` ORDER BY brand ASC;";
              $stmt_brands=$pdo->query($select_brand);
              $num = 0;
              while($brand=$stmt_brands->fetch()){
                $selected_brand=$brand['brand'];
                $selected_brand_id=$brand['brand_id'];
                echo '
                <tr>
                  <th scope="row">' . $num . '</th>
                  <td>' . strval($selected_brand) . '</td>
                  <td><p>';
                    $select_models = "SELECT models.model AS `model` FROM `models` WHERE models.id_brands = ?";
                    $stmt_models=$pdo->prepare($select_models);
                    $stmt_models->execute([$selected_brand_id]);
                    if($stmt_models->rowCount() >0){
                      while($models=$stmt_models->fetch()){
                        $selected_model=$models['model'];
                        echo $selected_model . ', ';
                      }
                    }else{
                      echo '<i>0 found</i>';
                    }
                  echo '
                  </p></td>
                </tr>';
                $num++;
              } 
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <?php include('footer.php'); ?>
</body>

<script>
  function deleteCar(carID) {
    var r = confirm("Are you sure?");
    if (r == true) {
      $.ajax({
        url: "./live_delete_car.php?car_id=" + carID,
        type: 'GET',
        dataType: 'json', // added data type
        success: function (res) {
          // done
        }
      });
      location.reload();
    }
  }
</script>

</html>