<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('css-js.php'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>

<body>

    <?php include('header.php'); ?>
    <section class="py-5">
        <div class="container-fluid" style="padding-top:10%;">
            <div class="container">
                <h3>Edit car:</h3>
                <hr />
                <?php
                    $car_id = $_POST['carID'];
                    $select_car = "SELECT
                                        cars.*,
                                        pictures.url,
                                        brands.*,
                                        models.model,
                                        fuel.fuel_type
                                    FROM
                                        cars
                                    INNER JOIN pictures ON pictures.id_cars = cars.id_cars
                                    INNER JOIN models ON models.id_models = cars.id_models
                                    INNER JOIN brands ON brands.id_brands = models.id_brands
                                    INNER JOIN fuel ON fuel.id_fuel = cars.id_fuel
                                    WHERE
                                        cars.id_cars = ?;";
                    $stmt_car = $pdo->prepare($select_car);
                    $stmt_car->execute([$car_id]);
                    $original_data = $stmt_car->fetch();
                    // print_r($original_data);
                ?>
                <form action="insert_car.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="brandsList" class="col-sm-2 col-form-label">Brands</label>
                        <div class="col-sm-10">
                            <?php
                                $select_brand="SELECT brands.brand AS `brand`, brands.id_brands AS `id_brand` FROM `brands` ORDER BY brand ASC;";
                                $stmt=$pdo->query($select_brand);
                                if($stmt->rowCount() > 0){
                                    echo '<select class="form-control" id="brandsList" name="brand" onchange="getModels(this)" required>';
                                    while($brand=$stmt->fetch()){
                                        $selected_brand=$brand['brand'];
                                        $selected_brand_id=$brand['id_brand'];
                                        if($selected_brand == $original_data['brand']){
                                            echo '                               
                                                <option value="'.strval($selected_brand_id).'" selected>'.strval($selected_brand).'</option>
                                            ';
                                        }else{
                                            echo '                               
                                                <option value="'.strval($selected_brand_id).'">'.strval($selected_brand).'</option>
                                            ';
                                        }
                                    }
                                    echo '</select>';
                                }else{
                                    echo '<select class="form-control" id="brandsList" disabled required>
                                    </select>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brandsList" class="col-sm-2 col-form-label">Models</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="modelsList" name="model" required>
                                <?php
                                    $select_models_for_brand = "SELECT models.id_models, models.model FROM models WHERE models.id_brands = ?;";
                                    $stmt=$pdo->prepare($select_models_for_brand);
                                    $original_brand = $original_data['id_brands'];
                                    $stmt->execute([$original_brand]);
                                    while($models=$stmt->fetch()){
                                        $selected_model = $models['model'];
                                        $select_model_id = $models['id_models'];
                                        if($selected_model == $original_data['model']){
                                            echo '                               
                                                <option value="'.strval($select_model_id).'" selected>'.strval($selected_model).'</option>
                                            '; 
                                        }else{
                                            echo '                               
                                                <option value="'.strval($select_model_id).'">'.strval($selected_model).'</option>
                                            '; 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brandsList" class="col-sm-2 col-form-label">Gear shift type</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="gear_shift" name="gear_shift" required>
                                <option value="manual">Manual</option>
                                <option value="automatic">Automatic</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brandsList" class="col-sm-2 col-form-label">Fuel type</label>
                        <div class="col-sm-10">
                            <?php
                                $select_fuel="SELECT fuel.fuel_type AS `fuel`, fuel.id_fuel AS `id_fuel` FROM fuel ORDER BY fuel.fuel_type ASC;";
                                $stmt=$pdo->query($select_fuel);
                                if($stmt->rowCount() > 0){
                                    echo '<select class="form-control" id="fuelList" name="fuel" required>';
                                    while($fuel=$stmt->fetch()){
                                        $selected_fuel=$fuel['fuel'];
                                        $selected_fuel_id=$fuel['id_fuel'];
                                        if($selected_fuel == $original_data['fuel_type']){
                                            echo '                               
                                                <option value="'.strval($selected_fuel_id).'" selected>'.strval($selected_fuel).'</option>
                                            ';
                                        }else{
                                            echo '                               
                                                <option value="'.strval($selected_fuel_id).'">'.strval($selected_fuel).'</option>
                                            ';
                                        }
                                    }
                                    echo '</select>';
                                }else{
                                    echo '<select class="form-control" id="fuelList" name="fuel" disabled required>
                                    </select>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="yearRegistration" class="col-sm-2 col-form-label">Year registered <i>(from 1901 and
                                up)</i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="yearRegistration" name="yearRegistration"
                                placeholder="Eg. 2020" maxlength="4" size="4" required
                                value="<?php echo $original_data['year_of_registration'];?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="imageOfCar" class="col-sm-2 col-form-label">Picture</label>
                        <div class="col-sm-10">
                            <input type="file" id="imageOfCar" name="imageOfCar" accept="image/*" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="imageOfCar" class="col-sm-2 col-form-label">Picture selected</label>
                        <div class="col-sm-10">
                            <img src="<?php echo $original_data['url'];?>" class="rounded float-left"
                                style="width: 18rem;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Price <i>(max of 10000.00)</i></label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" min="0.00" max="10000.00" step="any" id="price"
                                name="price" required value="<?php echo $original_data['price'];?>">
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>
</body>

<script>
    (function ($, window) {
        $.fn.replaceOptions = function (options) {
            var self, $option;

            this.empty();
            self = this;

            $.each(options, function (index, option) {
                $option = $("<option></option>")
                    .attr("value", option.value)
                    .text(option.text);
                self.append($option);
            });
        };
    })(jQuery, window);

    function getModels(sel) {
        //alert(sel.value);
        $.ajax({
            url: "./live_model_response.php?brand_id=" + sel.value,
            type: 'GET',
            dataType: 'json', // added data type
            success: function (res) {
                $("#modelsList").replaceOptions(res);
            }
        });
    }
</script>

</html>