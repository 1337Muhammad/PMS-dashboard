<?php 
session_start();
require_once("../../inc/config.php");

require_once("E:/xampp/htdocs/productms/inc/sAdmin.php");



if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $uId = $_GET['id'];

    $isExist = isExist($conn, "$uId", "users", "WHERE id=".$uId)[0];

    if($isExist == "1"){
        $isDeleted = deleteRow($conn, 'users', 'id='.$uId);
        if($isDeleted){
            $_SESSION['success'] = "User deleted !";
        }else{
            $_SESSION['queryError'] = "Error happened !";
        }
    }else{
        // User is not in db
        $_SESSION['notExist'] = "User is not in db !";
    }   

    header("location: ".URL."users/index.php");
}

?>