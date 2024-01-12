<?php require_once "controllerUserData1.php"; ?>

<?php
$page_title = 'Authorized Students';
require_once('includes/load.php');

$students = find_by_id('students', (int)$_GET['id']);

if (!$students) {
    $session->msg("d", "Missing students id.");
    redirect('students_table.php');
}

if (isset($_POST['authorized'])) {
    $req_fields = array('enrolled_course','first_name', 'last_name','contact','university','address', 'date_of_birth', 'gender', 'student_email');
    validate_fields($req_fields);
    if (empty($errors)) {
        $s_enrolledcourse = remove_junk($db->escape($_POST['enrolled_course']));
        $s_firstname = remove_junk($db->escape($_POST['first_name']));
        $s_lastname = remove_junk($db->escape($_POST['last_name']));        
        $s_contact = remove_junk($db->escape($_POST['contact']));
        $s_university = remove_junk($db->escape($_POST['university']));
        $s_address = remove_junk($db->escape($_POST['address']));
        $s_dob = remove_junk($db->escape($_POST['date_of_birth']));
        $s_gender = remove_junk($db->escape($_POST['gender']));
        $s_semail = remove_junk($db->escape($_POST['student_email']));


        $query  = "INSERT INTO enrolled_students (";
        $query .=" enrolled_course, first_name, last_name, contact, university, address, date_of_birth, gender, student_email";
        $query .=") VALUES (";
        $query .=" '{$s_enrolledcourse}','{$s_firstname}', '{$s_lastname}', '{$s_contact}','{$s_university}','{$s_address}','{$s_dob}', '{$s_gender}','{$s_semail}'";
        $query .=")";
        $query .=" ON DUPLICATE KEY UPDATE student_email='{$s_semail}'";

        if ($db->query($query)) {
            $session->msg('s',"students added ");
            redirect('usertable.php', false);
        } else {
            $session->msg('d',' Sorry failed to add!');
            redirect('students_table.php', false);
        }

    } else {
        $session->msg("d", $errors);
        redirect('add_students.php', false);
    }
}
?>
<?php include_once('layouts/header-sidebar.php'); ?>

<div class="main-skills">
        
        <div class="card1">
            <div class="content">
      
            <div class="row">
                <div class="panel panel-default">
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
        <div class="panel-heading">          
        </div>
        <div class="panel-body">
            <div class="col-md-7">
            <form method="post" action="authorized.php?id=<?php echo (int)$students['id'] ?>">
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Course</label>
                                    <select name="enrolled_course" class="form-control" id="enrolled_course" required="">
                                        <option value="" disabled selected>Select Course</option>
                                        <option value="HTML">HTML</option>
                                        <option value="CSS">CSS</option>
                                        <option value="JAVASCRIPT">JAVASCRIPT</option>
                                        <option value="PHP">PHP</option>
                                        <option value="GAME DEVELOPMENT & ANIMATION">GAME DEVELOPMENT & ANIMATION</option>
                                        <option value="CISCO WAN TECHNOLOGY">CISCO WAN TECHNOLOGY</option>
                                        <option value="CLOUD COMPUTING">CLOUD COMPUTING</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="last_name"
                                            value="<?php echo remove_junk($students['last_name']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="first_name"
                                            value="<?php echo remove_junk($students['first_name']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="contact"
                                            value="<?php echo remove_junk($students['contact']); ?>">
                                    </div>
                                </div>
                            </div><div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="university"
                                            value="<?php echo remove_junk($students['university']); ?>">
                                    </div>
                                </div>
                            </div><div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="address"
                                            value="<?php echo remove_junk($students['address']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="date_of_birth"
                                            value="<?php echo remove_junk($students['date_of_birth']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="gender"
                                            value="<?php echo remove_junk($students['gender']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="student_email"
                                            value="<?php echo remove_junk($students['student_email']); ?>">
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-4">
                                <button type="submit" name="authorized" class="btn btn-danger">Authorize</button>
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
