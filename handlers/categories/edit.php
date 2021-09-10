<?php
session_start();
require_once("../../inc/config.php");

if(isset($_POST['submit']) && isset($_GET['id']) && is_numeric($_GET['id'])){

    $catName = mysqli_real_escape_string($conn, trim(htmlspecialchars($_POST['catName']))); //new category name
    $catId = mysqli_real_escape_string($conn, trim(htmlspecialchars($_GET['id'])));

    // validate name
    $error = validateName($catName);
    if(empty($error)){
        // update
        $isUpdated = update($conn, "categories", "`name`='$catName'" , "`id`=$catId");
        // die($isUpdated);
        if($isUpdated){
            $_SESSION['success'] = "Category updated successfully";
        }else{
            $_SESSION['updateError'] = "Error updating category !!!";
        }
    }else{
        $_SESSION['validateError'] = "Error updating category !!!";
    }

    header("location: ".URL."categories/edit.php?id=$catId");   
}