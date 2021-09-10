<?php

session_start();
require_once("../../inc/config.php");



if(isset($_POST['submit'])){    //pName -> product name
    $pName = mysqli_real_escape_string($conn, $_POST['pName']);
    $pCode = mysqli_real_escape_string($conn, $_POST['pCode']);
    $pPrice = mysqli_real_escape_string($conn, $_POST['pPrice']);
    $pQty = mysqli_real_escape_string($conn, $_POST['pQty']);
    $pDesc = mysqli_real_escape_string($conn, $_POST['pDesc']);
    $pCat = mysqli_real_escape_string($conn, $_POST['pCat']); // isExist()?


    // Validation on user inputs
    if(isExist($conn, "$pCat", "categories", "WHERE id=".$pCat)){
        // $errors = [];
        // $errors = [
        //     validateName($pName),
        //     validateCode($pCode),
        //     validateNum($pPrice),
        //     validateNum($pQty),
        //     validateDesc($pDesc)
        // ];
        $pNameErr = validateName($pName);
        $pCodeErr = validateCode($pCode);
        $pPriceErr = validateNum($pPrice);
        $pQtyErr = validateNum($pQty);
        $pDescErr = validateDesc($pDesc);
        $errors = ['name'=>$pNameErr, 'code'=>$pCodeErr, 'price'=>$pPriceErr, 'qty'=>$pQtyErr, 'desc'=>$pDescErr];
        
        // clear $errors from NULL values
        foreach($errors as $key=>$error){
            if($error == NULL){
                unset($errors[$key]);
            }
        }
    }else{ //category id not found
        $_SESSION['notExist'] = "Category not found !!!";
        // return $_SESSION['notExist'];
        header("location:".URL."products/add.php");
    }



    // Based on validation if condiditons
    if(empty($errors)){
        // if no errors then insert category into db
        $isInserted = insert($conn, "products", "`name`, `code`, `price`, `quantity`, `desc`, `cat_id`", "'$pName', '$pCode', $pPrice, $pQty, '$pDesc', $pCat");
        if($isInserted){
            // redirect back with success msg
            $_SESSION['success'] = "Product added successfully !";
        }else{
            // error happened inserting data
            $_SESSION['queryError'] = "Error in query !";
        }
    }else{
        // if validation errors occured
        // echo "<pre>";
        // print_r($errors);
        // echo "</pre>";die;
        $_SESSION['validationError'] = $errors;
    }
    header("location: ".URL."products/add.php");

    // echo "<pre>";
    // print_r($errors);
    // echo "</pre>";
}

?>