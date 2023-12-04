<?php require_once "controllerUserData.php"; ?>
<?php
$page_title = 'Students Table';
require_once('includes/load.php');
require 'vendor/autoload.php'; // Include SimpleExcel
$students = join_student_table();
?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login_signup.php');
}
?>
<?php include_once('layouts/header-sidebar.php'); ?>

<div class="row">
    <div class="col-md-12">
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-right">
                    <a href="add_students.php" class="btn">Add New Student</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">ID</th>
                            <th class="text-center"> First Name </th>
                            <th class="text-center"> Last Name </th>
                            <th class="text-center"> Date of Birth </th>
                            <th class="text-center"> Gender </th>
                            <th class="text-center"> Major </th>
                            <th class="text-center"> University Email </th>
                            <th class="text-center"> Enrolled Courses </th> <!-- Change here -->
                            <th class="text-center"> Date Enrolled </th>
                            <th class="text-center" style="width: 100px;"> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $students):?>
                        <tr>
                            <td class="multiline-text" style="vertical-align: middle;"> <?php echo remove_junk($students['id']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['first_name']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['last_name']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['date_of_birth']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['gender']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['major']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['student_email']);?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['enrolled_courses']);?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['enrolled_at']);?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="edit_product.php?id=<?php echo (int)$students['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                                    <span class="fas fa-edit" style="color:forestgreen"></span>
                                    </a>
                                    <a href="delete_product.php?id=<?php echo (int)$students['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
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