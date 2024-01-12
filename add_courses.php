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
$page_title = 'Add courses';
require_once('includes/load.php');
$all_categories = find_all('courses');

if (isset($_POST['add_courses'])) {
    $req_fields = array('Course_Name', 'code', 'Course_Category', 'Course_Description', 'first_name', 'last_name', 'Start_Date', 'End_Date');
    validate_fields($req_fields);

    if (empty($errors)) {
        $c_code = remove_junk($db->escape($_POST['code']));
        $c_name = remove_junk($db->escape($_POST['Course_Name']));
        $c_cat = remove_junk($db->escape($_POST['Course_Category']));
        $c_descri = remove_junk($db->escape($_POST['Course_Description']));
        $c_fname = remove_junk($db->escape($_POST['first_name']));
        $c_lname = remove_junk($db->escape($_POST['last_name']));
        $c_Start_Date = remove_junk($db->escape($_POST['Start_Date']));
        $c_End_Date = remove_junk($db->escape($_POST['End_Date']));


        $query  = "INSERT INTO courses (";
        $query .=" course_code,course_name,category_id,course_description,instructor_first_name,instructor_last_name,start_date,end_date";
        $query .=") VALUES (";
        $query .=" '{$c_code}', '{$c_name}', '{$c_cat}', '{$c_descri}', '{$c_fname}', '{$c_lname}', '{$c_Start_Date}', '{$c_End_Date}'";
        $query .=")";
        $query .=" ON DUPLICATE KEY UPDATE course_name='{$c_name}'";

        if ($db->query($query)) {
            $session->msg('c',"course added ");
            redirect('add_courses.php', false);
        } else {
            $session->msg('d',' Sorry failed to add!');
            redirect('add_courses.php', false);
        }

    } else {
        $session->msg("d", $errors);
        redirect('add_courses.php', false);
    }
}
?>
<?php include_once('layouts/header-sidebar.php'); ?>
<div class="main-skills">
<div class="card">
                                <div class="content">
                                    
                                        <div class="col-sm-13">
                                            <div class="detail">
                                                <p class="detail-subtitle">Welcome Admin!</p>
                                                <p class="detail-subtitle"><?php echo display_msg($msg); ?></p>                                           
                                            </div>
                                        </div>
                                  
                                </div>
                            </div>
        <div class="card1">
            <div class="content">
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New Course</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" action="add_courses.php" class="clearfix">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="Course_Name" placeholder="Course name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="code"
                                            placeholder="Course Code">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="Course_Category"
                                            placeholder="Course Category">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="Course_Description"
                                            placeholder="Course Description" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="first_name"
                                            placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="last_name"
                                            placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="Start_Date"
                                            placeholder="Start Date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="End_Date"
                                            placeholder="End Date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                    <button type="submit" name="add_courses" class="btn">Add course</button>
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
