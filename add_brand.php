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
                <h3>Add brand:</h3>
                <hr />
                <form action="add_brand_to_db.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Brands" id="brand" name="brand">
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