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
                $select_brand="SELECT brands.brand AS `brand` FROM `brands` ORDER BY brand DESC;";
                $stmt=$pdo->query($select_brand);
                while($brand=$stmt->fetch()){
                  $selected_brand=$brand['brand'];
                  echo '
                  <label class="checkbox-inline">
                    <input type="checkbox" value="'.strval($selected_brand).'">'.strval($selected_brand).'
                  </label>';
                } 
              ?>
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
    </div>
  </section>

  <?php include('footer.php'); ?>
</body>

</html>