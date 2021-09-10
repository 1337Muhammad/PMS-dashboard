<?php 

require_once '../inc/header.php'; //header.php contains (config.php that have functions.php)
// require_once ROOT . "inc/conn.php";


?>

    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-success btn-lg" href="<?= URL ?>categories/add.php" role="button">Add New Category </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  All Categories  </h1>

    <div class="container">
        <div class="row">
            <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo (sessionMsg());     unsetSessionMsg(); ?>
                    <?php 
                        $cats = select($conn, '*', 'categories');
                        // $cats = [];
                        foreach($cats as $key => $cat){
                        ?>

                        <tr>
                            <th scope="row"><?= $key+1 ?></th>
                            <td><?= $cat['name'] ?></td>
                            <td>
                                <a href="<?= URL ?>categories/edit.php?id=<?= $cat['id'] ?>" class="btn btn-info">Edit <i class="bi bi-pencil-square"></i></a>
                                <a href="<?= URL ?>handlers/categories/delete.php?id=<?= $cat['id'] ?>" class="btn btn-danger">Delete <i class="bi bi-x-square-fill"></i></a>
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




