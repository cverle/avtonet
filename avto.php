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
        <form>
          <div class="form-group">
            <div class="container-fluid">
              <h3>Brands</h3>
            </div>
            <div class="container-fluid">
              <?php
                $select_brand="SELECT brands.brand AS `brand` FROM `brands` ORDER BY brand ASC;";
                $stmt=$pdo->query($select_brand);
                while($brand=$stmt->fetch()){
                  $selected_brand=$brand['brand'];
                  echo '
                  <label class="checkbox-inline">
                    <input type="checkbox" value="'.strval($selected_brand).'">'.strval($selected_brand).'
                  </label>';
                } 
              ?>
              <hr />
              <a href="add_brand.php" class="btn btn-success">Add brand?</a>
              <a href="add_model.php" class="btn btn-success">Add model?</a>
            </div>
          </div>
        </form>
        <!-- <div class="btn-group">
          <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Brands <span class="sr-only">Toggle Dropdown</span>
          </button>
          <div class="dropdown-menu">
            
          </div>
        </div> -->
        <?php 
          $select_all="SELECT * FROM users";
          $stmt=$pdo->query($select_all);
          while ($row = $stmt->fetch()) {
            echo '<h3 style="color:black;">' . $row['email'] . '<h3></br/>';
          }
        ?>
      </div>
      <div class="container">
        <table class="table table-striped">
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

</html>