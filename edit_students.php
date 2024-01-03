<?php require_once "controllerUserData.php"; ?>
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
$page_title = 'Edit students';
require_once('includes/load.php');

$students = find_by_id('students', (int)$_GET['id']);

if (!$students) {
    $session->msg("d", "Missing students id.");
    redirect('students.php');
}

if (isset($_POST['add_students'])) {
    $req_fields = array('llname', 'ffname', 'ddob', 'ggender', 'mmjor', 'ssemail', 'eecourses', 'eenrolledat');
    validate_fields($req_fields);

    if (empty($errors)) {
        $s_firstname = remove_junk($db->escape($_POST['ffname']));
        $s_lastname = remove_junk($db->escape($_POST['llname']));
        $s_dob = remove_junk($db->escape($_POST['ddob']));
        $s_gender = remove_junk($db->escape($_POST['ggender']));
        $s_major = remove_junk($db->escape($_POST['mmjor']));
        $s_semail = remove_junk($db->escape($_POST['ssemail']));
        $s_ecourses = remove_junk($db->escape($_POST['eecourses']));
        $s_enrolledat = remove_junk($db->escape($_POST['eenrolledat']));
        
        $query = "UPDATE students SET ";
        $query .= "code ='{$c_code}', ";
        $query .= "name ='{$c_name}', email ='{$c_descri}', status='{$c_sstatus}', is_active='{$c_iisactive}', registration_date='{$c_rrdate}' ";
        $query .= "WHERE id ='{$students['id']}'";

        $result = $db->query($query);
        
        

        if ($result && $db->affected_rows() === 1) {
            $session->msg('c', "students updated ");
            redirect('students.php', false);
        } else {
            $session->msg('d', ' Sorry failed to updated!');
            redirect('edit_students.php?id=' . $students['id'], false);
        }

    } else {
        $session->msg("d", $errors);
        redirect('edit_students.php?id=' . $students['id'], false);
    }
}
?>
<?php include_once('layouts/header-sidebar.php'); ?>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Edit students</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <form method="post" action="edit_students.php?id=<?php echo (int)$students['id'] ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cname"
                                            value="<?php echo remove_junk($students['name']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="qty">Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email"
                                            value="<?php echo remove_junk($students['email']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="code"
                                            value="<?php echo remove_junk($students['code']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="qty">Condition</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="status"
                                            value="<?php echo remove_junk($students['status']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Status</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="is_active"
                                            value="<?php echo remove_junk($students['is_active']); ?>">
                                    </div>
                                    <label for="qty">[ 1 ] Active [ 0 ] Not Active</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="qty">Registration Date</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="rrdate"
                                            value="<?php echo remove_junk($students['registration_date']); ?>">
                                    </div>
                                </div>
                            </div>
                          
                        <div class="col-md-4">
                                <button type="submit" name="students" class="btn btn-danger">Update</button>
                            </div>
                    </div>
                      
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .row {
        --bs-gutter-x: .5rem;
        margin-left: calc(1 * var(--bs-gutter-x));
        min-width: 900px;
    }

    .btn-danger {
        --bs-btn-color: #000;
        --bs-btn-bg: #1565c0;
        --bs-btn-border-color: #1565c0;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #198754;
        --bs-btn-hover-border-color: #1565c0;
        --bs-btn-focus-shadow-rgb: 225, 83, 97;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #1565c0;
        --bs-btn-active-border-color: #1565c0;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #1565c0;
        --bs-btn-disabled-bg: #1565c0;
        --bs-btn-disabled-border-color: #1565c0;
    }
</style>
<?php include_once('layouts/main-footer.php'); ?>
