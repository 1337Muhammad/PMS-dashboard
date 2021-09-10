<?php require_once '../inc/header.php'; ?>     

    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-primary btn-lg" href="<?=URL?>categories" role="button">View All Categories</a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  Add New Categoery  </h1>
    
    <div class="container">
        
        <?php
        echo sessionMsg();
        unsetSessionMsg();
        ?>
        
        <div class="row">
            <div class="col-10 mx-auto">
                <form class="p-4 m-3 border bg-gradient-info" action="<?= URL ?>handlers/categories/add.php" method="POST">
                    <div class="form-group">
                        <label for="cat">Category Name</label>
                        <input type="text" name="catName" class="form-control" id="cat" >
                    </div>
        
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-reply-all-fill"></i> Submit
                     </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

<?php require_once '../inc/footer.php'; ?>     




