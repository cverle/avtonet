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
                <h3>Add model:</h3>
                <hr />
                <form action="add_model_to_db.php" method="POST">
                    <div class="form-group row">
                        <label for="brandsList" class="col-sm-2 col-form-label">Brands</label>
                        <div class="col-sm-10">
                            <?php
                                $select_brand="SELECT brands.brand AS `brand`, brands.id_brands AS `id_brand` FROM `brands` ORDER BY brand ASC;";
                                $stmt=$pdo->query($select_brand);
                                if($stmt->rowCount() > 0){
                                    echo '<select class="form-control" id="brandsList" name="brand" onchange="getModels(this)">';
                                    while($brand=$stmt->fetch()){
                                    $selected_brand=$brand['brand'];
                                    $selected_brand_id=$brand['id_brand'];
                                    echo '                               
                                        <option value="'.strval($selected_brand_id).'">'.strval($selected_brand).'</option>
                                    ';
                                    }
                                    echo '</select>';
                                }else{
                                    echo '<select class="form-control" id="brandsList" disabled>
                                    </select>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brandsList" class="col-sm-2 col-form-label">Models</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="modelsList" name="model"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="imageOfCar" class="col-sm-2 col-form-label">Picture</label>
                        <div class="col-sm-10">
                            <input type="file" id="imageOfCar" name="imageOfCar" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brandsList" class="col-sm-2 col-form-label">Fuel type</label>
                        <div class="col-sm-10">
                            <?php
                                $select_fuel="SELECT fuel.fuel_type AS `fuel`, fuel.id_fuel AS `id_fuel` FROM fuel ORDER BY fuel.fuel_type ASC;";
                                $stmt=$pdo->query($select_fuel);
                                if($stmt->rowCount() > 0){
                                    echo '<select class="form-control" id="fuelList" name="fuel">';
                                    while($fuel=$stmt->fetch()){
                                    $select_fuel=$fuel['fuel'];
                                    $select_fuel_id=$fuel['id_fuel'];
                                    echo '                               
                                        <option value="'.strval($select_fuel_id).'">'.strval($select_fuel).'</option>
                                    ';
                                    }
                                    echo '</select>';
                                }else{
                                    echo '<select class="form-control" id="fuelList" name="fuel" disabled>
                                    </select>';
                                }
                            ?>
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