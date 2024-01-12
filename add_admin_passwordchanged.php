<?php require_once "controllerUserData1.php"; ?>

<?php
  $page_title = 'Password Changed';
  
require_once('includes/load.php');
?>
<?php include_once('layouts/header-sidebar.php'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Password Changed</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                        <div class="col-md-4 offset-md-4 form login-form">
                    <h2 class="text-center">Password changed!</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                        <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                        <form action="add_admin,php" method="POST">
                            <div class="form-group">
                                <input class="form-control button" type="submit" name="okay" value="Submit">
                            </div>
                        </form>
                    </div>
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
 