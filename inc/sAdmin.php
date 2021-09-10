<?php 


if(isset($_SESSION['isLogin'])){
    if($_SESSION['role'] != "sadmin"){
        // if not super admin redirect
        header('Location: ' .URL. "login.php");
    }
}else{
    // not ligged in
    header('Location: ' . URL . 'login.php');
}

