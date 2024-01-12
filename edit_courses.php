<?php require_once "controllerUserData1.php"; ?>
<?php
$page_title = 'Edit Courses';
require_once('includes/load.php');

$courses = find_by_id('courses', (int)$_GET['id']);

if (!$courses) {
    $session->msg("d", "Missing courses id.");
    redirect('courses.php');
}

if (isset($_POST['courses'])) {
    $req_fields = array('cname', 'code', 'course-cat', 'description', 'first_name', 'last_name', 'sdate', 'edate');
    validate_fields($req_fields);

    if (empty($errors)) {
        $c_code = remove_junk($db->escape($_POST['code']));
        $c_name = remove_junk($db->escape($_POST['cname']));
        $c_cat = remove_junk($db->escape($_POST['course-cat']));
        $c_descri = remove_junk($db->escape($_POST['description']));
        $c_fname = remove_junk($db->escape($_POST['first_name']));
        $c_lname = remove_junk($db->escape($_POST['last_name']));
        $c_sdate = remove_junk($db->escape($_POST['sdate']));
        $c_edate = remove_junk($db->escape($_POST['edate']));
        
        $query = "UPDATE courses SET ";
        $query .= "course_code = '{$c_code}', course_name = '{$c_name}', category_id = '{$c_cat}', ";
        $query .= "course_description = '{$c_descri}', instructor_first_name = '{$c_fname}', ";
        $query .= "instructor_last_name = '{$c_lname}', start_date = '{$c_sdate}', end_date = '{$c_edate}' ";
        $query .= "WHERE id ='{$courses['id']}'";
        
        
        $result = $db->query($query);
        
        

        if ($result && $db->affected_rows() === 1) {
            $session->msg('c', "courses updated ");
            redirect('courses.php', false);
        } else {
            $session->msg('d', ' Sorry failed to updated!');
            redirect('edit_courses.php?id=' . $courses['id'], false);
        }

    } else {
        $session->msg("d", $errors);
        redirect('edit_courses.php?id=' . $courses['id'], false);
    }
}
?>
<?php include_once('layouts/header-sidebar.php'); ?>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Edit courses</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <form method="post" action="edit_courses.php?id=<?php echo (int)$courses['id'] ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Course Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cname"
                                            value="<?php echo remove_junk($courses['course_name']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Course Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="code"
                                            value="<?php echo remove_junk($courses['course_code']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Description</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="description"
                                            value="<?php echo remove_junk($courses['course_description']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Instructor First Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="first_name"
                                            value="<?php echo remove_junk($courses['instructor_first_name']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Instructor Last Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="last_name"
                                            value="<?php echo remove_junk($courses['instructor_last_name']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Start date</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="sdate"
                                            value="<?php echo remove_junk($courses['start_date']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">End Date</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="edate"
                                            value="<?php echo remove_junk($courses['end_date']); ?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="courses" class="btn btn-danger col-md-4">Update</button>

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
