<?php

session_start();
// require_once("../../inc/conn.php");
// require_once("../../functions.php");
require_once("../../inc/config.php");

if(isset($_POST['catName'])){
    $catName = mysqli_escape_string($conn, $_POST['catName']);

    $errors = validateName($catName);
    // echo "<pre>";
    // print_r($errors);
    // echo "</pre>";die;

    if(empty($errors)){
        // if no errors then insert category into db
        $isInserted = insert($conn, "categories", "name", "$catName");
        if($isInserted){
            // redirect back with success msg
            $_SESSION['success'] = "Category added successfully !";
        }else{
            // error happened inserting data
            $_SESSION['queryError'] = "Error in query !";
        }
    }else{
        // if validation errors occured
        $_SESSION['validationError'] = $errors;
    }
    header("location: ".URL."categories/add.php");

    // echo "<pre>";
    // print_r($errors);
    // echo "</pre>";
}

// header("location:../../categories")
?>