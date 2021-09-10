<?php 

session_start();
require_once("../../inc/config.php");



if(isset($_POST['submit'])){    //pName -> product name
    $pId = mysqli_real_escape_string($conn, $_POST['pId']);
    $pName = mysqli_real_escape_string($conn, $_POST['pName']);
    $pCode = mysqli_real_escape_string($conn, $_POST['pCode']);
    $pPrice = mysqli_real_escape_string($conn, $_POST['pPrice']);
    $pQty = mysqli_real_escape_string($conn, $_POST['pQty']);
    $pDesc = mysqli_real_escape_string($conn, $_POST['pDesc']);
    $pCat = mysqli_real_escape_string($conn, $_POST['pCat']); // isExist()?

    
    // echo "<pre>";
    // print_r(var_dump($_POST));
    // echo "</pre>";die;

    if(isExist($conn, "$pCat", "categories", "WHERE id=".$pCat)){
        $pIdErr = validateNum($pId);
        $pNameErr = validateName($pName);
        $pCodeErr = validateCode($pCode);
        $pPriceErr = validateNum($pPrice);
        $pQtyErr = validateNum($pQty);
        $pDescErr = validateDesc($pDesc);
        $errors = ['name'=>$pNameErr, 'code'=>$pCodeErr, 'price'=>$pPriceErr, 'qty'=>$pQtyErr, 'desc'=>$pDescErr];


        foreach($errors as $key=>$error){
            if($error == NULL){
                unset($errors[$key]);
            }
        }
    }else{
        $_SESSION['notExist'] = "Category not found !!!";
        header("location:".URL."products/edit.php?id="."$pId");
    }

    // Based on validation if condiditons
    if(empty($errors)){
        // if no errors then insert category into db
        $isUpdated = update(
                    $conn, 
                    "products", 
                    "`name`='$pName', `code`='$pCode', `price`='$pPrice', `quantity`='$pQty', `desc`='$pDesc', `cat_id`='$pCat'", 
                    "products.id = $pId");
        if($isUpdated){
            // redirect back with success msg
            $_SESSION['success'] = "Product updated successfully !";
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
    header("location: ".URL."products/edit.php?id="."$pId");

}
?>