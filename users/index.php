<?php 

require_once '../inc/header.php'; 

require_once("E:/xampp/htdocs/productms/inc/sAdmin.php");


$users = select($conn, "*", "`users`");


?>     

    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-success btn-lg" href="<?= URL ?>users/add.php" role="button">Add New User </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  All Users  </h1>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php 
                    // echo "<pre>";
                    // print_r(var_dump($_SESSION));
                    // echo "</pre>";
                ?>
                <?php echo sessionMsg(); unsetSessionMsg(); ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col"> Name</th>
                    <th scope="col"> Email</th>
                    <th scope="col"> Role</th>
                    <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $key => $user){ ?>
                    <tr>
                        <th scope="row"><?= $key+1 ?></th>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td>
                            <a href="<?= URL ?>users/edit.php?id=<?= $user['id'] ?>" class="btn btn-info">Edit <i class="bi bi-pencil-square"></i></a>
                            <a href="<?= URL ?>handlers/users/delete.php?id=<?= $user['id'] ?>" class="btn btn-danger">Delete <i class="bi bi-x-square-fill"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>

               
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

<?php require_once '../inc/footer.php'; ?>     




