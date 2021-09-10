<?php require_once '../inc/header.php'; ?>  
  

    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-primary btn-lg" href="<?= URL ?>products/index.php" role="button">View All Products </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  Add New Product  </h1>

    <div class="container">

        <?php 
        $errors = isset($_SESSION['validationError'])?$_SESSION['validationError']:NULL;
        // echo "<pre>";
        // print_r(var_dump($errors));
        // echo "</pre>";
        echo (isset($_SESSION['success'])?$_SESSION['success']:NULL);
        ?>

        <div class="row">
            <div class="col-10 mx-auto">
                <form class="p-4 m-3 border bg-gradient-info" method="POST" action="<?= URL ?>handlers/products/add.php">
                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" name="pName" class="form-control" id="cat" >
                        <?php 
                            echo (isset($errors['name'])?$errors['name']:NULL); 
                        ?>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="productCode">Code</label>
                        <input type="text" name="pCode" class="form-control" id="cat" >
                        <?php 
                            echo (isset($errors['code'])?$errors['code']:NULL); 
                        ?>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Price</label>
                        <input type="text" int name="pPrice" class="form-control" id="cat" >
                        <?php 
                            echo (isset($errors['price'])?$errors['price']:NULL); 
                        ?>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="productQty">Quantity</label>
                        <input type="text" name="pQty"  class="form-control" id="cat" >
                            <?php 
                                echo (isset($errors['qty'])?$errors['qty']:NULL); 
                            ?>
                            <br>
                    </div>
                    <div class="form-group">
                        <label for="productDesc">Description</label>
                        <textarea name="pDesc" id="cat" class="form-control"></textarea>
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
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
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

        <?php
            unsetSessionMsg();
            unset($_SESSION['notExist']);
        ?>

        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

<?php require_once '../inc/footer.php'; ?>     




