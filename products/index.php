<?php require_once '../inc/header.php'; ?>     

    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-success btn-lg" href="<?= URL ?>products/add.php" role="button">Add New Product </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  All Products  </h1>

    <div class="container">
        <?php  

            $errors = sessionMsg();
            unsetSessionMsg(); 
            
        ?>
        <div class="row">
            <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $products = selectJoin(
                                            $conn,
                                            "categories.id AS catID , categories.name AS catName, products.name AS productName, products.id AS productId,
                                            price, quantity", "categories", "products",
                                            "categories.id = products.cat_id"
                                );
                                // echo "<pre>";
                                // print_r(var_dump($products));
                                // echo "</pre>";die;
                    foreach($products as $key=>$product){
                        ?>
                        <tr>
                            <th scope="row"><?= $key+1 ?></th>
                            <td><?= $product['catName'] ?></td>
                            <td><?= $product['productName'] ?></td>
                            <td><?= $product['price'] ?></td>
                            <td><?= $product['quantity'] ?></td>
                            <td>
                                <a href="<?= URL ?>products/edit.php?id=<?= $product['productId'] ?>" class="btn btn-info">Edit <i class="bi bi-pencil-square"></i></a>
                                <a href="<?= URL ?>handlers/products/delete.php?id=<?= $product['productId'] ?>" class="btn btn-danger">Delete <i class="bi bi-x-square-fill"></i></a>
                            </td>
                        </tr>
                        <?php
                    }        
                    ?>
                </tbody>
                </table>

               
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

<?php require_once '../inc/footer.php'; ?>     




