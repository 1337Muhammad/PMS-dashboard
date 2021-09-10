<?php 

session_start();
require_once("../../inc/config.php");

// if user not logged in redirect him
require_once("E:/xampp/htdocs/productms/inc/sAdmin.php"); 


if(isset($_POST['submit'])){    //pName -> product name
    $uName = mysqli_real_escape_string($conn, $_POST['name']);
    $uEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $uRole = mysqli_real_escape_string($conn, $_POST['role']);
    $uPass = $_POST['password']; //without escaping to avoid password be changed

    $uId = mysqli_real_escape_string($conn, $_GET['id']);
    if(! isExist($conn, '*', "`users`", "WHERE id="."'$uId'")){ 
        //if $_GET['id'] not exist in db
        //check if supplied email is related to that id
        // else return with Error happened
        $errors[] = "User id is not found !";
        $_SESSION['errors'] = $errors;
        
        header("location: ". URL . "users/edit.php?id=$uId");
        exit;
    }

    // die($uId);

    // var_dump($_POST);

    // validate inputs one by one
    $errors[] = validateName($uName);
    $errors[] = validateEmail($uEmail);     //but email must be unique so we check in db - excluding the $uEmail
    
    // validateRole
    if(!($uRole == "sadmin" or $uRole == "admin")){
        $errors[] = "User role must be sadmin or admin !";
    }

    //validate password if found
    if(! empty($uPass)){
        $errors[] = validatePass($uPass); //password validation
    }

    foreach($errors as $key=>$error){
        if($error == NULL){
            unset($errors[$key]);
        }
    }
    // echo "<pre>";
    // print_r(var_dump($errors));
    // echo "</pre>";die;


    /**Before any updates $errors[] must be empty */
    if(empty($errors)){ // if no validation errors

        if(! empty($uPass)){ // if new password exist 
            // update hashed Password , name , email & role
            $hashedPass = password_hash($uPass, PASSWORD_DEFAULT);

            // sql query count($mails) where id = $uId
            // if >= 1       Email is duplicated - query error
            
            $isUpdated = update($conn, 
                        "`users`", 
                        "`name`='$uName' , `email`='$uEmail', `role`='$uRole', `pass`='$hashedPass'", 
                        "id='$uId'");
            $_SESSION['success'] = "User updated successfully !";

        }else{ // old password remains : update only email,name,role
            $isUpdated = update($conn, 
            "`users`", 
            "`name`='$uName' , `email`='$uEmail', `role`='$uRole'", 
            "id='$uId'");
            $_SESSION['success'] = "User updated successfully !";
        }
    }
    header("location: " . URL . "users/edit.php?id=$uId");

    

    // var_dump($errors);

}

?>






































































<?php
// if(isset($_POST['submit'])){    //pName -> product name
//     $uName = mysqli_real_escape_string($conn, $_POST['name']);
//     $uEmail = mysqli_real_escape_string($conn, $_POST['email']);
//     $uRole = mysqli_real_escape_string($conn, $_POST['role']);
//     $uPass = mysqli_real_escape_string($conn, $_POST['password']);
//     // get user id using email from db

//     /**
//      * 
//      */

    
    
//     if(isExist($conn, "*", "users", "WHERE id="."'$uId'")){
//         // is user is exist then validate        
//         $uEmailErr = validateName($uEmail);
//         $uNameErr = validateName($uName);
        
//         // role must be 'sadmin' or 'admin'
//         if(($uRole != 'sadmin') || ($uRole != 'admin')){
//             $_SESSION['errors'] = "User Role is not valid must be 'admin' or 'sadmin'";
//             header("location: ". URL);
//             // echo "<pre>";
//             // print_r(var_dump($_SESSION['errors']));
//             // echo "</pre>";die;
//         }
//         //password is default when edit
        

//         // $errors = ['name'=>$pNameErr, 'code'=>$pCodeErr, 'price'=>$pPriceErr, 'qty'=>$pQtyErr, 'desc'=>$pDescErr];


//         // foreach($errors as $key=>$error){
//         //     if($error == NULL){
//         //         unset($errors[$key]);
//         //     }
//         // }

//     }else{
//         $_SESSION['notExist'] = "User is no exist !!!";
//         header("location:".URL."products/edit.php?id="."$pId");
//     }

//     // Based on validation if condiditons
//     if(empty($errors)){
//         // if no errors then insert category into db
//         $isUpdated = update(
//                     $conn, 
//                     "products", 
//                     "`name`='$pName', `code`='$pCode', `price`='$pPrice', `quantity`='$pQty', `desc`='$pDesc', `cat_id`='$pCat'", 
//                     "products.id = $pId");
//         if($isUpdated){
//             // redirect back with success msg
//             $_SESSION['success'] = "Product updated successfully !";
//         }else{
//             // error happened inserting data
//             $_SESSION['queryError'] = "Error in query !";
//         }
//     }else{
//         // if validation errors occured
//         // echo "<pre>";
//         // print_r($errors);
//         // echo "</pre>";die;
//         $_SESSION['validationError'] = $errors;
//     }
//     header("location: ".URL."products/edit.php?id="."$pId");

// }
?>