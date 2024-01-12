<?php require_once "controllerUserData1.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: add_admin_resetcode.php');
            }
        }else{
            header('Location: add_admin_otp.php');
        }
    }
}else{
    header('Location: login_signup/login-user.php');
}
?>
<?php
  $page_title = 'Add Admin';
  
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
                <form action="add_admin.php" method="POST" autocomplete="">
                    <h2 class="text-center">Welcome to ERovoutika <br> Electronics Robotics Automation</h2>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <i class="fas fa-user"></i>
                        <input class="form-control" type="text" name="name" placeholder="Name" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                    <i class="fas fa-envelope"></i>
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                    <i class="fas fa-lock"></i>
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                    <i class="fas fa-lock"></i>
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Create Account">
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
 