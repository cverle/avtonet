<!DOCTYPE html>
<html lang="en">

<head>
  <?php require('css-js.php'); ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>

<body>
  <?php include('header.php'); ?>
    <!-- cars table -->
  <section class="py-5">
    <div class="container-fluid" style="padding-top:10%;">
      <div class="container">
        <div class="d-flex justify-content-center">
          <h1>All cars</h1>
        </div>
        <hr />
        <div class="d-flex justify-content-center">
          <?php
            if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
              echo'
                <a href="add_car.php" class="btn btn-success">Add car</a>
              ';
            }
          ?>
        </div>
        <table id="carTables" class="table table-striped display" style="width:100%">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Brand</th>
              <th scope="col">Model</th>
              <th scope="col">Year of registration</th>
              <th scope="col">Fuel type</th>
              <th scope="col">Gear shift type</th>
              <th scope="col">Price</th>
              <th scope="col">&nbsp;</th>
              <th scope="col">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
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
                                    cars.year_of_registration ASC;";
              $stmt = $pdo->query($sql_select_cars);
              $count_cars = 1;
              while($cars=$stmt->fetch()){
                $id_selected_car = $cars['id_cars'];
                echo '
                <tr>
                  <th scope="row">' . $count_cars . '</th>
                  <td>' . $cars['brand'] . '</td>
                  <td>' . $cars['model'] . '</td>
                  <td>' . $cars['year_of_registration'] . '</td>
                  <td>' . $cars['fuel_type'] . '</td>
                  <td>' . $cars['gear_shifts'] . '</td>
                  <td>' . $cars['price'] . ' &#8381;</td>';

                  $session_check_edit = "";
                  $session_check_delete = "";
                  if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
                    $session_check_edit = '<form action="edit_car.php" method="POST"><input type="hidden" name="carID" value="' . $id_selected_car . '"><button type="submit" class="btn btn-success" style="float: right;">Edit</button></form>';
                    $session_check_delete = '<div class="btn btn-danger" style="float: left;" onclick="deleteCar(' . $id_selected_car . ')">Delete</div>';
                  }
                  
                  echo'
                  <td>' . $session_check_edit . '</td>
                  <td>' . $session_check_delete . '</td>
                </tr>';
                $count_cars++;
              }
            ?>
          </tbody>
        </table>
      </div>
      <script>
        $(document).ready(function () {
          $('#carTables').DataTable();
        });
      </script>
    </div>
  </section>
  <section class="py-5">
    <div class="container-fluid" style="padding-top:10%;">
      <div class="container">
        <div class="d-flex justify-content-center">
          <h1>Car brands and models</h1>
        </div>
        <hr />
        <div class="d-flex justify-content-center">
          <?php
            if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
              echo'
                <a href="add_brand.php" class="btn btn-success" style="margin:4px;">Add brand</a>
                <a href="add_model.php" class="btn btn-success" style="margin:4px;">Add model</a>
              ';
            }
          ?>
        </div>
        <table id="carBrandsModels" class="table table-striped display" style="width:100%">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Brand</th>
              <th scope="col">Models</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $select_brand="SELECT brands.brand AS `brand`, brands.id_brands AS `brand_id` FROM `brands` ORDER BY brand ASC;";
              $stmt_brands=$pdo->query($select_brand);
              $num = 1;
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
      <script>
        $(document).ready(function () {
          $('#carBrandsModels').DataTable();
        });
      </script>
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