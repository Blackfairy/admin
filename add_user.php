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
$page_title = 'Add usertable';
require_once('includes/load.php');
$all_categories = find_all('usertable');

if (isset($_POST['add_user'])) {
    $req_fields = array('name', 'email','password', 'code', 'status', 'is_active', 'registration_date');
    validate_fields($req_fields);

    if (empty($errors)) {
        $u_name = remove_junk($db->escape($_POST['name']));
        $u_email = remove_junk($db->escape($_POST['email']));
        $u_password = remove_junk($db->escape($_POST['password']));
        $u_code = remove_junk($db->escape($_POST['code']));
        $u_status = remove_junk($db->escape($_POST['status']));
        $c_iisactive = remove_junk($db->escape($_POST['is_active']));
        $u_registration_date = remove_junk($db->escape($_POST['registration_date']));


        $query  = "INSERT INTO usertable (";
        $query .=" name,email,password,code,status,is_active,registration_date";
        $query .=") VALUES (";
        $query .=" '{$u_name}','{$u_email}','{$u_password}', '{$u_code}', '{$u_status}', '{$c_iisactive}', '{$u_registration_date}'";
        $query .=")";
        $query .=" ON DUPLICATE KEY UPDATE email='{$u_email}'";

        if ($db->query($query)) {
            $session->msg('s',"New user added ");
            redirect('add_user.php', false);
        } else {
            $session->msg('d',' Sorry failed to add!');
            redirect('add_user.php', false);
        }

    } else {
        $session->msg("d", $errors);
        redirect('add_user.php', false);
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
                    <span>Add New User</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" action="add_user.php" class="clearfix">
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-4">
                                    <div class="input-group">
                                        
                                    <input type="text" class="form-control" name="name"
                                            placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="email"
                                            placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="password"
                                            placeholder="password">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="code"
                                            placeholder="OTP Code">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="status"
                                            placeholder="Condition">
                                    </div>
                                </div> <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="is_active"
                                            placeholder="Status">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="date" class="form-control" name="registration_date"
                                            placeholder="Date Created">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                <button type="submit" name="add_user" class="btn">Add User</button>
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
