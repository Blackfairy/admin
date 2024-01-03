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
$page_title = 'User Table';
require_once('includes/load.php');
require 'vendor/autoload.php'; // Include SimpleExcel
$students = join_user_table(); // Include your sql.php file
?>
<?php
 $c_enrollees = count_enrollees();
 $c_courses = count_courses();
 $c_email = count_by_id('usertable');
 $c_verified = count_verified('usertable');
?>

<?php include_once('layouts/header-sidebar.php'); ?>
      <div class="main-skills">
      <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="icon-big text-center">
                                                <i class="orange fas fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="detail">
                                                <p class="detail-subtitle">VERIFIED USERS</p>
                                                <span class="number"><?php  echo $c_verified['total']; ?></span>
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
                                                    
                                <a href="add_user.php" class="btn">Add New User</a>
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
                        
                            </div>
                            
                            <div class="panel-heading clearfix">
                                        <div class="pull-right">
                                        
                            </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered" id="courseTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">ID</th>
                                            <th class="text-center"> Name </th>
                                            <th class="text-center"> Email </th>
                                            <th class="text-center"> Code </th>
                                            <th class="text-center"> Status </th>
                                            <th class="text-center"> Is Active </th>
                                            <th class="text-center"> Registration Date </th>
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
                                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['is_active']); ?></td>
                                            <td class="text-center" style="vertical-align: middle;"> <?php echo remove_junk($students['registration_date']); ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="edit_usertable.php?id=<?php echo (int)$students['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                                                    <span class="fas fa-edit" style="color:forestgreen"></span>
                                                    </a>
                                                    <a href="delete_user.php?id=<?php echo (int)$students['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
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
