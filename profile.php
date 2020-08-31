<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('css-js.php'); ?>
</head>

<body>

    <?php include('header.php'); 
    if(!isset($_SESSION['user_id']) && $_SESSION['user_id'] == ''){
        header('location: login.php');
        die();
    }?>
    <section class="py-5">
        <div class="container-fluid" style="padding-top:10%;">
            <div class="container">
                <h3>Add a car:</h3>
                <hr />
                <form action="#" method="POST">
                    <div class="form-group row">
                        <label for="brandsList" class="col-sm-2 col-form-label">Brands</label>
                        <div class="col-sm-10">
                            <?php
                                $select_brand="SELECT brands.brand AS `brand` FROM `brands` ORDER BY brand DESC;";
                                $stmt=$pdo->query($select_brand);
                                if($stmt->rowCount() > 0){
                                    echo '<select class="form-control" id="brandsList">';
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
                    <div class="form-group row">
                        <label for="brandsList" class="col-sm-2 col-form-label">Models</label>
                        <div class="col-sm-10">
                            <?php
                                $select_models="SELECT models.model AS `models` FROM models ORDER BY models.model DESC;";
                                $stmt=$pdo->query($select_models);
                                if($stmt->rowCount() > 0){
                                    echo '<select class="form-control" id="modelsList">';
                                    while($models=$stmt->fetch()){
                                    $selected_models=$models['models'];
                                    echo '                               
                                        <option>'.strval($selected_models).'</option>
                                    ';
                                    }
                                    echo '</select>';
                                }else{
                                    echo '<select class="form-control" id="modelsList" disabled>
                                    </select>';
                                }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>
</body>

</html>