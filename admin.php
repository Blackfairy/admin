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
$page_title = 'Admin Table';
require_once('includes/load.php');
require 'vendor/autoload.php'; // Include SimpleExcel
$admin = join_admin();
?>

<?php include_once('layouts/header-sidebar.php'); ?>
      <div class="main-skills">
        
        <div class="card1">
            <div class="content">
                            
                <div class="row">
                    <div class="col-md-12">
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                        <div class="card">
                                <div class="content">
                                    <div class="row">
                                    
                                        <div class="col-sm-13">
                                            <div class="detail">
                                                <p class="detail-subtitle">Welcome Admin!</p>
                                                <p class="detail-subtitle">Have A Cup Off Coffe!</p>                                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading clearfix">
                <div class="pull-right">
                    <a href="add_admin.php" class="btn">Add New Admin</a>
                    <a href="add_admin_forgotpassword.php" class="btn">Change Password</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">ID</th>
                            <th class="text-center"> Name </th>
                            <th class="text-center"> Email </th>
                            <th class="text-center"> Date Created </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admin as $admin):?>
                        <tr>
                            <td class="multiline-text" style="vertical-align: middle;"> <?php echo remove_junk($admin['id']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($admin['name']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($admin['email']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($admin['created_at']);?></td>
                            
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
<style>
    .main-skills .card {
    min-width: 237px;
    max-width: 237px;
    margin: 10px;
    background: transparent;
    border-color: lightblue;
    text-align: center;
    border-radius: 20px;
    padding: 10px;
    box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
}    .main-skills .card1 {
    min-width: fit-content;
    max-width: fit-content;
    margin: 10px;
    background: transparent;
    border-color: lightblue;
    text-align: center;
    border-radius: 20px;
    padding: 10px;
    box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
}


</style>
<?php include_once('layouts/main-footer.php'); ?>
