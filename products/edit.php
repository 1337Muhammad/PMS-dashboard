<?php require_once '../inc/header.php'; ?>  
  
<?php 
    // get productData from $_GET id so that user edit it
    // 1st check if $_GET has valid data, then check if it exists in db 
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $pId = $_GET['id']; //$productId

        $prdouctExist = isExist($conn, '*', 'products', 'WHERE id='.$pId)[0]; //returns "1" or "0"
        // echo "<pre>";
        // print_r(var_dump($prdouctExist));
        // echo "</pre>";die;
        if($prdouctExist == "1"){
            // if exist then view its data (name, code, ...)
            $product = selectJoinOne(
                        $conn, 
                        "categories.`name` AS catName, categories.`id` AS catId, products.`name` as pName, products.`id` AS pId, `code`, `price`, `quantity`, `desc`",
                        "products",
                        "categories",
                        "products.cat_id = categories.id",
                        "WHERE products.`id` = $pId"
            );
            // die($pId);

        }elseif($prdouctExist == "0"){
            // product doesnt exist
            // die("product dowsnt exists");
            $_SESSION['notExist'] = "Product doesn't Exist";
            header("location:".URL."products/edit.php?id=$pId");
        }
    }else{
        // $_GET['id'] -> is not valid nor empty
        header("location:".URL."products/index.php");
    }
    // $product = selectOne($conn, )
?>

    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-primary btn-lg" href="<?= URL ?>products/index.php" role="button">View All Products </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  Add New Product  </h1>

    <div class="container">

        <?php 
        $errors = isset($_SESSION['validationError'])?$_SESSION['validationError']:NULL;
        echo (isset($_SESSION['success'])?$_SESSION['success']:NULL);
        ?>

        <div class="row">
            <div class="col-10 mx-auto">
                <form class="p-4 m-3 border bg-gradient-info" method="POST" action="<?= URL ?>handlers/products/edit.php">
                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" name="pName" value="<?= $product['pName']; ?>" class="form-control" id="cat" >
                        <input type="hidden" name="pId" value="<?= $product['pId']; ?>">
                        <?php 
                            echo (isset($errors['name'])?$errors['name']:NULL); 
                        ?>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="productCode">Code</label>
                        <input type="text" name="pCode" value="<?= $product['code'] ?>" class="form-control" id="cat" >
                        <?php 
                            echo (isset($errors['code'])?$errors['code']:NULL); 
                        ?>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Price</label>
                        <input type="text" int name="pPrice" value="<?= $product['price'] ?>" class="form-control" id="cat" >
                        <?php 
                            echo (isset($errors['price'])?$errors['price']:NULL); 
                        ?>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="productQty">Quantity</label>
                        <input type="text" name="pQty" value="<?= $product['quantity'] ?>"  class="form-control" id="cat" >
                            <?php 
                                echo (isset($errors['qty'])?$errors['qty']:NULL); 
                            ?>
                            <br>
                    </div>
                    <div class="form-group">
                        <label for="productDesc">Description</label>
                        <textarea name="pDesc" id="cat" class="form-control"><?= $product['desc'] ?></textarea>
                        <?php 
                            echo (isset($errors['desc'])?$errors['desc']:NULL); 
                        ?>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="productCategory">Category</label>
                        <?php 
                            echo (isset($_SESSION['notExist'])?$_SESSION['notExist']:NULL); 
                        ?>
                        <br>
                        <select name="pCat" class="form-control" aria-label="Default select example">
                            <!-- <option selected >Choose Category</option> -->
                    <?php 
                        $cats = select($conn, "id, name", "categories");
                        foreach($cats as $cat){
                            
                            ?>

                            <option <?php if($cat['id']==$product['catId']){ echo 'selected'; } ?> value="<?= $cat['id'] ?>">
                            <?= $cat['name'] ?>
                            </option>

                            <?php
                        }
                    ?>
                        </select>
                    </div>  
                    
                    <button type="submit" name="submit" class="btn btn-success">
                        <i class="bi bi-reply-all-fill"></i> Submit
                    </button>
                </form>
            </div>

            <?php unsetSessionMsg(); ?>

        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

<?php require_once '../inc/footer.php'; ?>     




