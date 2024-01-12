<?php require_once "controllerUserData1.php"; ?>

<?php
  $page_title = 'Forgot Password';
  
require_once('includes/load.php');
?>
<?php include_once('layouts/header-sidebar.php'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Forgot Password</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                <form action="add_admin_forgotpassword.php" method="POST" autocomplete="">
                    <h2 class="text-left">Forgot your Password?</h2>
                    <p class="text-left">Enter your email address</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Reset Password">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-1 * var(--bs-gutter-y));
    margin-right: calc(1 * var(--bs-gutter-x));
    margin-left: calc(.01 * var(--bs-gutter-x));
}
</style>  
<?php include_once('layouts/main-footer.php'); ?>
 