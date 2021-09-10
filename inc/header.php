<?php

session_start();
require_once("config.php");
// require_once(URL."inc/sAdmin.php");

//  //
$url = "http://localhost:8080/productms/";

if(!isset($_SESSION['isLogin']) or $_SESSION['isLogin']==false){
    header("location: ".$url."login.php");
}
//  //

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>  </title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <!-- <a class="navbar-brand" href="#">Navbar</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= URL ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>categories">Categories</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>products">Products</a>
      </li>

      <?php if($_SESSION['role'] != "sadmin"){
          }else{
            ?>
            <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>users">Users</a>
            </li>
            <?php
          }
        ?>
      
    </ul>

    <ul class="navbar-nav mr-right">

      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>profile.php?id=<?= $_SESSION['adminId'] ?>">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>logout.php">Logout</a>
      </li>
      
    </ul>
   
  </div>
</nav>
