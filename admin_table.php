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
$students = join_admin();
?>
<?php include_once('layouts/header-sidebar.php'); ?>

<div class="row">
    <div class="col-md-12">
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-right">
                    <a href="admin_table.php" class="btn">Add New User</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">ID</th>
                            <th class="text-center"> Name </th>
                            <th class="text-center"> Email </th>
                            <th class="text-center"> Code </th>
                            <th class="text-center"> Status </th>
                            <th class="text-center"> Date Created </th>
                            <th class="text-center" style="width: 100px;"> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $students):?>
                        <tr>
                            <td class="multiline-text" style="vertical-align: middle;"> <?php echo remove_junk($students['id']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['name']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['email']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['code']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['status']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['created_at']); ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="edit_user.php?id=<?php echo (int)$students['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                                    <span class="fas fa-edit" style="color:forestgreen"></span>
                                    </a>
                                    <a href="delete_admin.php?id=<?php echo (int)$students['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                                    <span class="fas fa-trash" style="color:red"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .multiline-text {
        max-width: 200px; /* Adjust the maximum width as needed */
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
    }
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