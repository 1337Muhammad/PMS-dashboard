<?php 

require_once '../inc/header.php'; 

// if user not logged in , redirect him
require_once("E:/xampp/htdocs/productms/inc/sAdmin.php");

// else{...

?>     

<?php 
    // get User data from $_GET id
    // 1st check if $_GET has valid data, then check if it exists in db 
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $uId = $_GET['id']; //$productId

        $userFound = isExist($conn, '*', 'users', 'WHERE id='.$uId)[0]; //returns "1" or "0"
        // echo "<pre>";
        // print_r(var_dump($userFound));
        // echo "</pre>";die;
        if($userFound == "1"){
            // if exist then view its data (name, email, role)
            $user = selectOne($conn, "*", "`users`", "WHERE `id`=$uId");
            // echo "<pre>";
            // print_r(var_dump($user));
            // echo "</pre>";
            // die();

        }elseif($userFound == "0"){
            // user doesnt exist
            // die("user dowsnt exists");
            $_SESSION['notExist'] = "user doesn't Exist";
            header("location:".URL."users/index.php");
        }
    }else{
        // $_GET['id'] -> is not valid or empty
        header("location:".URL."users/index.php");
    }
?>

    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-primary btn-lg" href="#" role="button">View All Users </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  Edit User Info  </h1>

    <div class="container">

        <?php 
        if(isset($_SESSION['errors'])){
            $errors = array($_SESSION['errors']);
            foreach($_SESSION['errors'] as $error){
            ?>
                <p><?= $error; ?></p>
            <?php
            }
            unset($_SESSION['errors']);
        }
        ?>

        <?php 
            if(isset($_SESSION['success'])){
                ?>
                <p><?= $_SESSION['success']; ?></p>
                <?php
                unset($_SESSION['success']);
            }
        ?>

        <div class="row">
            <div class="col-10 mx-auto">
                <form class="p-4 m-3 border bg-gradient-info" method="POST" action="<?= URL ?>handlers/users/edit.php?id=<?= $uId ?>">
                    <div class="form-group">
                        <label for="name"> Name</label>
                        <input type="text" name="name" value="<?= $user['name']; ?>" class="form-control" id="name" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="<?= $user['email']; ?>" class="form-control" id="email" >
                    </div>
                    <div class="form-group">
                        <label for="email">New Password</label>
                        <input type="password" name="password" value="" class="form-control" id="email" >
                    </div>
                    <div class="form-group">
                        <label for="pass">Role</label>
                        <input type="role" name="role"  value="<?= $user['role']; ?>" class="form-control" id="pass" >
                    </div>
        
                    <button type="submit" name="submit" class="btn btn-success">
                        <i class="bi bi-reply-all-fill"></i> Submit
                     </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

<?php require_once '../inc/footer.php'; ?>     




