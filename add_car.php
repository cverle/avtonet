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
                                    echo '<select class="form-control" id="brandsList" name="brand">';
                                    while($brand=$stmt->fetch()){
                                    $selected_brand=$brand['brand'];
                                    $selected_brand_id=$brand_id['id_brand'];
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
                            <?php
                                $select_brand="SELECT brands.brand AS `brand` FROM `brands` ORDER BY brand ASC;";
                                $stmt=$pdo->query($select_brand);
                                if($stmt->rowCount() > 0){
                                    echo '<select class="form-control" id="brandsList" name="brand">';
                                    while($brand=$stmt->fetch()){
                                    $selected_brand=$brand['brand'];
                                    echo '                               
                                        <option>'.strval($selected_brand).'</option>
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
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>
</body>

</html>