<?php

require_once '../inc/header.php';

require_once("E:/xampp/htdocs/productms/inc/sAdmin.php");

?>

    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-primary btn-lg" href="<?= URL."users/index.php" ?>" role="button">View All Users </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  Add New User  </h1>

    <div class="container">
        
        <?php 
            if(isset($_SESSION['success'])){
                ?>
                <p><?= $_SESSION['success']; ?></p>
                <?php
                unset($_SESSION['success']);
            }
        ?>

        <?php 
            if(isset($_SESSION['emailExist'])){
                ?>
                <p><?= $_SESSION['emailExist']; ?></p>
                <?php
                unset($_SESSION['emailExist']);
            }
        ?>

        <?php 
            if(isset($_SESSION['required'])){
                ?>
                <p><?= $_SESSION['required']; ?></p>
                <?php
                unset($_SESSION['required']);
            }
        ?>

        <?php 
            if(isset($_SESSION['queryError'])){
                ?>
                <p><?= $_SESSION['queryError']; ?></p>
                <?php
                unset($_SESSION['queryError']);
            }
        ?>

        <?php 
            if(isset($_SESSION['errors'])){
                foreach($_SESSION['errors'] as $error){
                ?>
                    <p><?= $error; ?></p>
                <?php
                }
                unset($_SESSION['errors']);
            }
        ?>


        <div class="row">
            <div class="col-10 mx-auto">
                <form class="p-4 m-3 border bg-gradient-info" method="POST" action="<?= URL ?>handlers/users/add.php">
                    <div class="form-group">
                        <label for="name"> Name</label>
                        <input type="text" name="name" class="form-control" id="name" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" >
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" name="password" class="form-control" id="pass" >
                    </div>
        
                    <button type="submit" name="submit" class="btn btn-success">
                        <i class="bi bi-reply-all-fill"></i> Submit
                     </button>
                </form>
            </div>
        </div>
    </div>


<?php require_once '../inc/footer.php'; ?>     




