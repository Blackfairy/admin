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
                header('Location: login_signup/login-user.php');
            }
        }else{
            header('Location: login_signup/login-user.php');
        }
    }
}else{
    header('Location: login_signup/login-user.php');
}
?>
<?php
  $page_title = 'Dashboard';
  require_once('includes/load.php');
  require_once('includes/sql.php'); // Include your sql.php file
?>
<?php
 $c_enrollees = count_enrolled();
 $c_courses = count_courses();
 $c_email = count_by_id('usertable');
 $c_verified = count_active('students');
?>

<?php include_once('layouts/header-sidebar.php'); ?>

<section class="main">
      <div class="main-top">
        <h1>Dashboard</h1>
      </div>
      <div class="main-skills">
        <div class="card" style="min-width: 400px">
                <div class="datepicker-here" data-language="en" date-inline="true"></div>
        </div>
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="icon-big text-center">
                            <i class="teal fas fa-user"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="detail">
                            <p class="detail-subtitle">Enrolled Students</p>
                            <span class="number"><?php  echo $c_enrollees['total']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        <i class="fas fa-users"></i> For this Week
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="icon-big text-center">
                            <i class="violet fas fa-book"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="detail">
                            <p class="detail-subtitle">Courses</p>
                            <span class="number"><?php  echo $c_courses['total']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        <i class="fas fa-stopwatch"></i> For this Month
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="icon-big text-center">
                            <i class="orange fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="detail">
                            <p class="detail-subtitle">Registered Users</p>
                            <span class="number"><?php  echo $c_email['total']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        <i class="fas fa-envelope-open-text"></i> For this week
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="icon-big text-center">
                            <i class="orange fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="detail">
                            <p class="detail-subtitle">Active Students</p>
                            <span class="number"><?php  echo $c_verified['total']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        <i class="fas fa-envelope-open-text"></i> For this week
                    </div>
                </div>
            </div>
        </div>
      </div>
      <section class="main-course">

<?php include_once('layouts/main-footer.php'); ?>
