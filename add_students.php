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
$page_title = 'Add Student';
require_once('includes/load.php');
$all_categories = find_all('students');

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


        $query  = "INSERT INTO students (";
        $query .=" first_name,last_name,date_of_birth,gender,major,student_email,enrolled_courses,enrolled_at";
        $query .=") VALUES (";
        $query .=" '{$s_firstname}', '{$s_lastname}', '{$s_dob}', '{$s_gender}', '{$s_major}', '{$s_semail}', '{$s_ecourses}', '{$s_enrolledat}'";
        $query .=")";
        $query .=" ON DUPLICATE KEY UPDATE student_email='{$s_semail}'";

        if ($db->query($query)) {
            $session->msg('s',"students added ");
            redirect('add_students.php', false);
        } else {
            $session->msg('d',' Sorry failed to added!');
            redirect('students.php', false);
        }

    } else {
        $session->msg("d", $errors);
        redirect('add_students.php', false);
    }
}
?>
<?php include_once('layouts/header-sidebar.php'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New students</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" action="add_students.php" class="clearfix">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="llname" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="ffname"
                                            placeholder="First Name">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="date" class="form-control" name="ddob"
                                            placeholder="Date of Birth">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="ggender"
                                            placeholder="Gender">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="mmjor"
                                            placeholder="Major">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="ssemail"
                                            placeholder="Student Email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="eecourses"
                                            placeholder="Enrolled Courses">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="eenrolledat"
                                            placeholder="Enrolled Date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                <button type="submit" name="add_students" class="btn">Add students</button>
                                    </div>
                                </div>
                            </div>
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
