<?php require_once '../inc/header.php'; ?>


    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-primary btn-lg" href="<?= URL."categories" ?>" role="button">View All Categories </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  Edit Categoery  </h1>

    <div class="container">
        <?php
            // echo ($_SESSION['success']);
            echo sessionMsg();
            unsetSessionMsg();
        ?>
        <?php 
            $catId = NULL; //default value
            if(isset($_GET['id']) && is_numeric($_GET['id'])){ //GET method has data with key id and its a numeric value
                $catId = $_GET['id'];
                // echo "<pre>";
                // print_r($catId);
                // echo "</pre>";die;
                $isExist = isExist($conn, "$catId", "categories", "WHERE id=".$catId)[0];
                if($isExist){ //check if id exist in categories table
                    $catName = selectOne($conn, 'name', 'categories', 'WHERE id='.$catId);
?>

                <div class="row">
                        <div class="col-10 mx-auto">
                            <form class="p-4 m-3 border bg-gradient-info" method="POST" action="<?= URL; ?>handlers/categories/edit.php?id=<?= $catId; ?>">
                                <div class="form-group">
                                    <label for="cat">Category Name</label>
                                    <input value="<?= $catName['name'] ?>" name="catName" type="text" class="form-control" id="cat" >
                                </div>
                    
                                <button type="submit" class="btn btn-success" name="submit">
                                    <i class="bi bi-reply-all-fill"></i> Submit
                                </button>
                            </form>
                        </div>
                    </div>


<?php
                }else{//id doesnt exist in categories
                    // $catName['name'] = "Category not found !!!";
                    // echo "<pre>";
                    // print_r("not here");
                    // echo "</pre>";
                    header("location: ".URL."categories");
                    // exit();
                }
            }else{//no data in GET['id]
                // $catName['name'] = "Category not found !!!";
                // echo "<pre>";
                // print_r("not here");
                // echo "</pre>";
                
                header("location: ".URL."categories");
                // exit;
            }
        ?>

</div> <!-- end container -->
    <!-- Optional JavaScript; choose one of the two! -->

<?php require_once '../inc/footer.php'; ?>     




