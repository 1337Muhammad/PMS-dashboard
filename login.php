<?php
session_start();
include 'inc/config.php'; 

if(isset($_SESSION['isLogin'])){
    header("location: ".URL);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >

    <title>Login</title>
  </head>
  <body>
    <h1 class="p-5 text-center">Login</h1> 

    <div class="container">
        <?php 

        // echo "<pre>";
        // print_r(var_dump($_SESSION));
        // echo "</pre>";die;
        if(isset($_SESSION['errors'])){
            echo $_SESSION['errors'];
            // echo gettype($_SESSION['errors']);
            
        }
        unset($_SESSION['errors'])
        ?>
        
        <div class="row">
            <div class="col-6 mx-auto">
                <form class="p-4 m-3 border bg-gradient-info" action="<?= URL; ?>handlers/users/login.php" method="POST">
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


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" ></script>



  </body>
</html>
