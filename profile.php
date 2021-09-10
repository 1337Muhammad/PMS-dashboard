<?php 
require_once 'inc/header.php'; //header.php contains (config.php that have functions.php)
// session_start();
?>
<?php 
    if(isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id']==$_SESSION['adminId'])){  //required | numeric | and only allowed for logged in user
        // echo "<pre>";
        // print_r($_GET);
        // echo "</pre>";die;
        $uId = $_GET['id'];
        if(isExist($conn, "`id`", "`users`", "WHERE id='$uId'")){
            $user = selectOne($conn, "`name`, `email`, `role`, created_at, updated_at", "`users`", "WHERE id='$uId'");
            // echo "<pre>";
            // print_r($user);
            // echo "</pre>";die;
        }else{
            // die("one");
            $_SESSION['errors'] = "Errors occured -- User id no in db :)";
            header("location: ".URL."index.php");
        }
    }else{
        // die("two");
        $_SESSION['errors'] = "Errors occured -- sql_injection threat :)";
        header("location: ".URL."index.php");
    }
?>


    <h1 class=" p-3 border display-4">User</h1>

    <div class="container">
        <div class="row">
            <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo (sessionMsg());     unsetSessionMsg(); ?>

                        <tr>
                            <!-- <th scope="row">ttt</th> -->
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td><?= $user['updated_at'] ?></td>
                            <td></td>
                        </tr>   

                </tbody>
                </table>

               
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

<?php require_once 'inc/footer.php'; ?>     




