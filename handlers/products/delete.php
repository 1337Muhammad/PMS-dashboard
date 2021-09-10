<?php 
session_start();
require_once("../../inc/config.php");

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $pId = $_GET['id'];

    $isExist = isExist($conn, "$pId", "products", "WHERE id=".$pId)[0];

    if($isExist){
        $isDeleted = deleteRow($conn, 'products', 'id='.$pId);
        if($isDeleted){
            $_SESSION['success'] = "Product deleted !";
        }else{
            $_SESSION['queryError'] = "Error happened !";
        }
    }else{
        // Product is not in db
        $_SESSION['notExist'] = "Product is not in db !";
    }   

    header("location: ".URL."products");
}

?>