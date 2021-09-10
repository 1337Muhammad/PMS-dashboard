<?php 

session_start();
require_once("../../inc/config.php");

if(isset($_POST['submit'])){
    
    if(!(empty($_POST['email'])) AND !(empty($_POST['password']))){

        // die("not empty");
        
        $userEmail = mysqli_real_escape_string($conn, trim(htmlspecialchars($_POST['email'])));
        $userPass = mysqli_real_escape_string($conn, trim(htmlspecialchars($_POST['password'])));

        // validate email format
        $userEmailErr = validateEmail($userEmail);

        if(empty($userEmailErr)){ //no format validation error
            // now we check user credentials from db
            $userEmailExist = isExist($conn, "*", "users", "WHERE email="."'$userEmail'")[0];
            // echo "<pre>";
            // print_r(var_dump($userEmailExist));
            // echo "</pre>";die;
            if($userEmailExist == "1"){
                // check if password matches the email record
                $user =  selectOne($conn, "*", "`users`", "WHERE email='$userEmail'");                
                $user['pass'] = password_verify($userPass, $user['pass']);
                // var_dump($user['pass']);die;

                if($user['pass']){ //
                    // beo@mail.com : pass123 : $2y$10$0Ong0cf9XkgvZPKCZNbps.iCHCdp9M0ePV/9t5fpux5ed4YaiG0fG
                    // save user data in SESSION and rediect back to index.php
                    $_SESSION['adminId'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['isLogin'] = true;
                    
                    header("location: ".URL);
                }else{
                    $_SESSION['errors'] = "Invalid credentials !";
                    header("location: ".URL."login.php");
                }
            }else{
                $_SESSION['errors'] = "Invalid credentials !";
                header("location: ".URL."login.php");
            }
        }else{
            // email format is not valid  -> redirect back
            $_SESSION['errors'] = "Email format is not valid !";
            header("location: ".URL."login.php");
        }
    }else{
        // redirect back with "this field is required"
        $_SESSION['errors'] = "Email and password are requried !";
        header("location: ".URL."login.php");
    }
}else{
    header("location: ".URL."login.php");
}

