<?php require_once "controllerUserData1.php"; ?>

<?php
  $page_title = 'OTP';
  
require_once('includes/load.php');
?>
<?php include_once('layouts/header-sidebar.php'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New Admin</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                <form action="add_admin_otp.php" method="POST" autocomplete="off">
				
                    <h2 class="text-center">Verify Your Account</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check" value="Submit">
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
 