<?php require_once "controllerUserData.php"; ?>
<?php 
if ($fetch_info) {
    // Check if the entered password matches the stored password
    if (password_verify($_SESSION['password'], $fetch_info['password'])) {
        // Redirect only if not already on the dashboard
        if (!isset($_SESSION['redirected'])) {
            $_SESSION['redirected'] = true;
            header('Location: dashboard.php');
            exit();
        }
    } else {
        // Handle the case of incorrect password
        echo "Incorrect password";
        // You may also want to redirect or display an error message
    }
} else {
    // Handle the case when the email is not found in the database
    echo "Email not found";
    // You may also want to redirect or display an error message
}

?>
<?php
$page_title = 'Edit usertable';
require_once('includes/load.php');

$usertable = find_by_id('usertable', (int)$_GET['id']);

if (!$usertable) {
    $session->msg("d", "Missing usertable id.");
    redirect('usertable.php');
}

if (isset($_POST['usertable'])) {
    $req_fields = array('name', 'code', 'email','status', 'is_active', 'rrdate');
    validate_fields($req_fields);

    if (empty($errors)) {
        $c_code = remove_junk($db->escape($_POST['code']));
        $c_name = remove_junk($db->escape($_POST['name']));
        $c_descri = remove_junk($db->escape($_POST['email']));
        $c_sstatus = remove_junk($db->escape($_POST['status']));
        $c_iisactive = remove_junk($db->escape($_POST['is_active']));
        $c_rrdate = remove_junk($db->escape($_POST['rrdate']));

        $query = "UPDATE usertable SET ";
        $query .= "code ='{$c_code}', ";
        $query .= "name ='{$c_name}', email ='{$c_descri}', status='{$c_sstatus}', is_active='{$c_iisactive}', registration_date='{$c_rrdate}' ";
        $query .= "WHERE id ='{$usertable['id']}'";

        $result = $db->query($query);
        
        

        if ($result && $db->affected_rows() === 1) {
            $session->msg('u', "usertable updated! ");
            redirect('usertable.php', false);
        } else {
            $session->msg('d', ' Sorry failed to update!');
            redirect('edit_usertable.php?id=' . $usertable['id'], false);
        }

    } else {
        $session->msg("d", $errors);
        redirect('edit_usertable.php?id=' . $usertable['id'], false);
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
                <form method="post" action="edit_usertable.php?id=<?php echo (int)$usertable['id'] ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name"
                                            value="<?php echo remove_junk($usertable['name']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="qty">Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email"
                                            value="<?php echo remove_junk($usertable['email']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="code"
                                            value="<?php echo remove_junk($usertable['code']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="qty">Condition</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="status"
                                            value="<?php echo remove_junk($usertable['status']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Status</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="is_active"
                                            value="<?php echo remove_junk($usertable['is_active']); ?>">
                                    </div>
                                    <label for="qty">[ 1 ] Active [ 0 ] Not Active</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="qty">Registration Date</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="rrdate"
                                            value="<?php echo remove_junk($usertable['registration_date']); ?>">
                                    </div>
                                </div>
                            </div>
                          
                        <div class="col-md-4">
                                <button type="submit" name="usertable" class="btn btn-danger">Update</button>
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
