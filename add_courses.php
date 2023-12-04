<?php require_once "controllerUserData.php"; ?>

<?php
$page_title = 'Add courses';
require_once('../includes/load.php');
$all_categories = find_all('courses');

if (isset($_POST['add_courses'])) {
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


        $query  = "INSERT INTO courses (";
        $query .=" course_code,course_name,category_id,course_description,instructor_first_name,instructor_last_name,start_date,end_date";
        $query .=") VALUES (";
        $query .=" '{$c_code}', '{$c_name}', '{$c_cat}', '{$c_descri}', '{$c_fname}', '{$c_lname}', '{$c_sdate}', '{$c_edate}'";
        $query .=")";
        $query .=" ON DUPLICATE KEY UPDATE course_name='{$c_name}'";

        if ($db->query($query)) {
            $session->msg('c',"courses added ");
            redirect('add_courses.php', false);
        } else {
            $session->msg('d',' Sorry failed to added!');
            redirect('courses.php', false);
        }

    } else {
        $session->msg("d", $errors);
        redirect('add_courses.php', false);
    }
}
?>
<?php include_once('../layouts/header-sidebar.php'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New courses</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" action="add_courses.php" class="clearfix">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cname" placeholder="Course name">
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
 
                                        <input type="text" class="form-control" name="course-cat"
                                            placeholder="Course Category">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="description"
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
                                        <input type="text" class="form-control" name="sdate"
                                            placeholder="Start Date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="edate"
                                            placeholder="End Date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                    <button type="submit" name="add_courses" class="btn">Add courses</button>
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

<?php include_once('../layouts/main-footer.php'); ?>
