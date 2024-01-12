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
$page_title = 'Courses';
require_once('includes/load.php');
require 'vendor/autoload.php'; // Include SimpleExcel
$courses = join_course_table();
// Function to get the current date and time in Asia/Manila timezone
?>
<?php
 $c_courses = count_courses();
?>

<?php include_once('layouts/header-sidebar.php'); ?>
      <div class="main-skills">
      <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="icon-big text-center">
                                                <i class="orange fas fa-book"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="detail">
                                                <p class="detail-subtitle">COURSES</p>
                                                <span class="number"><?php  echo $c_courses['total']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                            <hr />
                                            <div class="stats">
                                            <?php echo display_msg($msg); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                            <div class="content">
                                                <div class="row">   
                                                <div class="col-md-16">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="search" placeholder="Search">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="footer">
                                                    <hr />
                                                    <div class="stats">
                                                    
                                <a href="add_courses.php" class="btn">Add New Course</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <div class="card1">
            <div class="content">
                            
                <div class="row">
                    <div class="col-md-12">
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                       
            <div class="panel-body">
                    <table class="table table-bordered" id="courseTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">ID</th>
                            <th class="text-center"> Course Code </th>
                            <th class="text-center"> Course Name </th>
                            <th class="text-center"> Course Description </th>
                            <th class="text-center"> Instructor First Name </th>
                            <th class="text-center"> Instructor Last Name </th>
                            <th class="text-center"> Start Date </th>
                            <th class="text-center"> End Date </th> <!-- Change here -->
                            <th class="text-center" style="width: 100px;"> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course):?>
                        <tr>
                            <td class="multiline-text" style="vertical-align: middle;"> <?php echo remove_junk($course['id']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($course['course_code']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($course['course_name']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($course['course_description']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($course['instructor_first_name']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($course['instructor_last_name']); ?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($course['start_date']);?></td>
                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($course['end_date']);?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="edit_courses.php?id=<?php echo (int)$course['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                                    <span class="fas fa-edit" style="color:forestgreen"></span>
                                    </a>
                                    <a href="delete_courses.php?id=<?php echo (int)$course['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
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
            </div>
        </div>
      </div>
<style>
    .main-skills .card {
    min-width: 250px;
    max-width: 250px;
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
<script>
    // Function to filter table rows based on user input
    function filterTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("courseTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows (excluding the first row which contains headers)
        for (i = 1; i < tr.length; i++) {
            var rowVisible = false;

            // Loop through all columns in each row
            for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    // Check if the current column contains the search query
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        rowVisible = true;
                        break; // No need to check other columns once a match is found
                    }
                }
            }

            // Display or hide the row based on the search result
            tr[i].style.display = rowVisible ? "" : "none";
        }
    }

    // Attach the filterTable function to the input field's 'keyup' event
    document.getElementById("search").addEventListener("keyup", filterTable);
</script>

<?php include_once('layouts/main-footer.php'); ?>
