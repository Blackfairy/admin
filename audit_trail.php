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
$page_title = 'Audit Trail';
require_once('includes/load.php');
include_once('layouts/header-sidebar.php');

// Mapping array for table names
$table_name_mapping = array(
    'courses' => 'Courses',
    'usertable' => 'Usertable',
    'admin' => 'Admin',
    'course_category' => 'Course Categories'
);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        Audit Trail
                    </strong>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = find_all('audit_trail');

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) :
                                        ?>
                                        <tr>
                                            <td><?php echo ($row['id']); ?></td>
                                            <td><?php echo isset($table_name_mapping[$row['table_name']]) ? $table_name_mapping[$row['table_name']] : $row['table_name']; ?></td>
                                            <td><?php echo ($row['action']); ?></td>
                                            <td><?php echo ($row['timestamp']); ?></td>
                                        </tr>
                                <?php endwhile;
                                } else {
                                    echo "No records found";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/main-footer.php'); ?>
