<?php 
session_start();
require_once("../../inc/config.php");

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $catId = $_GET['id'];

    $isExist = isExist($conn, "$catId", "categories", "WHERE id=".$catId)[0];

    if($isExist){
        // if cat id exist
        // delete related products to that category first then delete the category
        //select * from products left join categories where categories.id = products.cat_id
        /**SELECT * FROM products JOIN categories WHERE products.cat_id=categories.id */
        // $sql = " ";
        $products_cat = selectJoin($conn, "categories.id as catId, products.id as pId","categories","products", "categories.id = products.cat_id", "WHERE products.cat_id = '$catId'");
        foreach($products_cat as $product){ //delete profucts related to $catId one by one
            /**array(2) {
             ["catId"]=>
            string(1) "1"
            ["pId"]=>
            string(1) "1"
            } */
            $isproductDeleted = deleteRow($conn, 'products', "id=".$product['pId']);
            if($isproductDeleted !== true){
                $_SESSION['errors'] = "Error happened deleting products !";
            }
        }
        // echo "<pre>";
        // print_r($products_cat);
        // echo "</pre>";die;

        $isDeleted = deleteRow($conn, 'categories', 'id='.$catId);
        if($isDeleted){
            $_SESSION['success'] = "Category deleted !";
        }else{
            $_SESSION['queryError'] = "Error happened !";
        }
    }else{
        // category is not in db
        $_SESSION['notExist'] = "Category is not in db !";
    }   

    header("location: ".URL."categories");
}

?>