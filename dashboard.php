<?php require_once "controllerUserData.php"; ?>
<?php
  $page_title = 'Dashboard';
  require_once('includes/load.php');
  require_once('includes/sql.php'); // Include your sql.php file
?>
<?php
 $c_enrollees = count_enrollees();
 $c_courses = count_courses();
 $c_email = count_by_id('usertable');
 $c_verified = count_verified('usertable');
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
                            <p class="detail-subtitle">New Enrollee</p>
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
                            <p class="detail-subtitle">OTP Sent</p>
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
                            <p class="detail-subtitle">Authenticated Email</p>
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
        <h1>Charts and Graphs</h1>
        <div class="course-box">
          <div class="course">
            <div class="box">
                <div class="content">
                    <div class="head">
                        <h5 class="mb-0">Visitors Overview</h5>
                        <h6 class="mb-0" style="font-size: 10px;">Current year website visitor data</h6>
     
                    </div>
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="trafficflow"></canvas>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="content">
                    <div class="head">
                        <h5 class="mb-0">Enrollee Overview</h5>
                        <h6 class="mb-0" style="font-size: 10px;">Current year enrollee data</h6>
    
                    </div>
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="sales"></canvas>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="content">
                    <div class="head">
                        <h5 class="mb-0">Most Visited Pages</h5>
                        <h6 class="mb-0" style="font-size: 10px;">Current year website visitor data</h6>
                        
                    </div>
                    <div class="canvas-wrapper">
                        <table class="table table-striped">
                            <thead class="success">
                                <tr>
                                    <th>Page Name</th>
                                    <th class="text-end">Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>/index.html<a href="/homepage/index.html"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">11 </td>
                                </tr>
                                <tr>
                                    <td>/course.php <a href="/courses.php"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">7 </td>
                                </tr>
                                <tr>
                                    <td>/about.html <a href="/homepage/about.html"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>

<?php include_once('layouts/main-footer.php'); ?>
