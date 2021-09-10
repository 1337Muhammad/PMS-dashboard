<?php

// Validation functions 
function validateName($value){  //  required | string | max:50 | min:2
    // $errors = [];
    if(empty($value)){
        return "This field is required";
    }elseif(! is_string($value) or is_numeric($value)){
        return "Enter a valid name value";
    }elseif(strlen($value)>50){
        return "Name maximum allowed value is 50 char";
    }elseif(strlen($value)<2){
        return "Name minimum allowed value is 2 char";
    }
}

function validateCode($code){ // required | max:50
    if(empty($code)){
        return "This field is required";
    }elseif(strlen($code)>50){
        return "Maximum allowed value is 50 char";
    }
}

function validateNum($num){ // required | number |
    if(empty($num)){
        return "This field is required";
    }elseif(!is_numeric($num)){
        return "This field must be numeric value";
    }
}

function validateDesc($desc){ // reuired | min:2 |
    if(empty($desc)){
        return "This field is required";
    }elseif(strlen($desc) > 50000){
        return "Too long description";
    }elseif(strlen($desc) < 2){
        return "Minimum allowed value is 2 char";
    }
}

function validateEmail($email){
    if(empty($email)){
        return "Email is required !";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return "Email format is not valid";
    }elseif(strlen($email)>50){
        return "Email maximium length is 50 character";
    }
}

/**
 *     if(empty($password)){
     *   $errors[] = "password is required";
    *}elseif(!is_string($password)){
    *    $errors[] = "password have to be string";
   * }elseif(strlen($password) < 5 || strlen($password) > 25){
  *      $errors[] = "password have to be between 5 and 25 chars";
 *   }
 */
function validatePass($pass){
    if(!is_string($pass)){
        return "Password must be string";
    }elseif(strlen($pass)<5 or strlen($pass)>30){
        return "Password must be between 5 and 30 character";
    }
}



// //                                                  




// db
// select multiple rows
function select($conn, $fields, $table, $others=NULL){
    $sql = "SELECT $fields FROM $table ";
    if($others !== NULL){
        $sql .= " $others";
    }

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        // data exists
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
        $rows = [];
    }

    return $rows;
}

// select one row and return it
function selectOne($conn, $fields, $table, $others=NULL){
    $sql = "SELECT $fields FROM $table ";
    if(!empty($others)){
        $sql .= $others;
    }
    $sql .= " LIMIT 1";

    // echo "<pre>";
    // print_r($sql);
    // echo "</pre>";die;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }else{
        $row = [];
    }
    return $row;
}

function selectJoin($conn, $fields, $table1, $table2, $cond, $others=NULL){
    /**
     * SELECT categories.name, products.name 
     * FROM products JOIN categories 
     * ON categories.id = products.id
     */
    $sql = "SELECT $fields 
            FROM $table1 JOIN $table2
            ON $cond";
    if(!empty($others)){
        $sql .= " $others";
    }
    // echo "<pre>";
    // print_r($sql);
    // echo "</pre>";die;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
        $rows = [];
    }
    return $rows;
}

function selectJoinOne($conn, $fields, $table1, $table2, $cond, $others=NULL){
    /**
     * SELECT categories.name, products.name 
     * FROM products JOIN categories 
     * ON categories.id = products.id
     */
    $sql = "SELECT $fields 
            FROM $table1 JOIN $table2
            ON $cond";
    if(!empty($others)){
        $sql .= " $others";
    }
    $sql .= " LIMIT 1"; //ensure it query returns one row

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
    }else{
        $row = [];
    }
    return $row;
}

function insert($conn, $table, $fields, $values){
    $sql = "INSERT INTO $table ($fields) VALUES ($values) ";
    // echo "<pre>";
    // print_r($sql);
    // echo "</pre>";
    // die;
    $isInserted = mysqli_query($conn, $sql);
    return $isInserted;
}

function update($conn, $table, $set, $cond){
    // UPDATE `categories` SET `name`='Computers' WHERE id=5
    $sql = "UPDATE $table SET $set WHERE $cond";
    $isUpdated = mysqli_query($conn, $sql);
    // echo "<pre>";
    // print_r($sql);
    // echo "</pre>";die;
    return $isUpdated;
}

function deleteRow($conn, $table, $cond){
    $sql = "DELETE FROM $table WHERE $cond";
    $isDeleted = mysqli_query($conn, $sql);
    // echo "<pre>";
    // print_r($sql);
    // echo "</pre>";die;
    // if($isDeleted){
    //     $_SESSION['success'] = "Category deleted !";
    // }
    return $isDeleted;
}


// check if row exist in db using id
function isExist($conn, $field, $table, $cond){
    $sql = "SELECT EXISTS (SELECT $field FROM $table $cond)";
    // SELECT EXISTS (SELECT products.id FROM products WHERE id=9)
    $result = mysqli_query($conn, $sql);
    // echo "<pre>";
    // print_r($sql);
    // echo "</pre>";die;
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_row($result);
    }
    return $row;
}

// check if $_SESSION has (query, validate, success or notExist) values and return them
function sessionMsg(){
    if(isset($_SESSION['queryError'])){ //query err
        return ("{$_SESSION['queryError']}");
    }elseif(isset($_SESSION['validationError'])){ //validation err
        $valErr = $_SESSION['validationError'];
        // echo "<pre>";
        // print_r(var_dump($valErr));
        // echo "</pre>";die;
        return ($valErr);
    }elseif(isset($_SESSION['success'])){ //success
        return ("{$_SESSION['success']}");
    }elseif(isset($_SESSION['notExist'])){
        return ("{$_SESSION['notExist']}");
    }
}

// unset $_SESSION msg
function unsetSessionMsg(){
    unset($_SESSION['queryError']);
    unset($_SESSION['validationError']);
    unset($_SESSION['success']);
    unset($_SESSION['notExist']);
}
