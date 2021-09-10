<?php

session_start();

require_once("E:/xampp/htdocs/productms/inc/sAdmin.php");




require_once("../../inc/config.php");



// var_dump($_POST);die;


if(isset($_POST['submit'])){    //uName -> user name
    $uName = mysqli_real_escape_string($conn, trim(htmlspecialchars($_POST['name'])));
    $uEmail = mysqli_real_escape_string($conn, trim(htmlspecialchars($_POST['email'])));
    $uPass = mysqli_real_escape_string($conn, trim(htmlspecialchars($_POST['password'])));
    $uRole = "admin";   //default


    // Validation
    if(!empty($uName) AND !empty($uEmail) AND !empty($uPass)){

        // before we validate all inputs we check if the email exist
        if(isExist($conn, "*", "`users`", "WHERE email="."'$uEmail'")[0]=="1"){
            // return back with $_SESSION['exists']
            $_SESSION['emailExist'] = "Email is already registerd";
            header("location: ".URL."users/add.php");
            exit();
        }

        $errors[] = validateName($uName);
        $errors[] = validateEmail($uEmail);
        $errors[] = validatePass($uPass);

        // clear $errors[] from NULL values
        foreach($errors as $key=>$error){
            if($error == NULL){
                unset($errors[$key]);
            }
        }
        
        
    }else{ //empty fields
        $_SESSION['required'] = "All fields are requried !";
        // return $_SESSION['notExist'];
        header("location:".URL."users/add.php");
        exit();
    }



    // Based on validation if condiditons
    if(empty($errors)){
        // if no errors then insert category into db
        // but 1st encrypt password
        $uPass = password_hash($uPass, PASSWORD_DEFAULT);
        // die($uPass);
        // 123456 : $2y$10$2CiyjKGhCjrVyawrNqleYegUD1Q4YpdG1dgAJMGL6YSfdCnRXym/W
        $isInserted = insert($conn, "users", "`name`, `email`, `pass`, `role`", "'$uName', '$uEmail', '$uPass', '$uRole'");
        if($isInserted){
            // redirect back with success msg
            $_SESSION['success'] = "Admin added successfully !";
        }else{
            // error happened inserting data
            $_SESSION['queryError'] = "Error in query !";
        }
    }else{
        // if validation errors occured
        // echo "<pre>";
        // print_r($errors);
        // echo "</pre>";die;
        $_SESSION['errors'] = $errors;
    }
    header("location: ".URL."users/add.php");

    // echo "<pre>";
    // print_r($errors);
    // echo "</pre>";
}

?>