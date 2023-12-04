<?php require_once "controllerUserData.php"; ?>

<?php
$page_title = 'Add usertable';
require_once('includes/load.php');
$all_categories = find_all('usertable');

if (isset($_POST['add_user'])) {
    $req_fields = array('nname', 'eemail','ppass', 'ccode', 'sstatus', 'ccreatedat');
    validate_fields($req_fields);

    if (empty($errors)) {
        $u_nname = remove_junk($db->escape($_POST['nname']));
        $u_eemail = remove_junk($db->escape($_POST['eemail']));
        $u_ppass = remove_junk($db->escape($_POST['ppass']));
        $u_ccode = remove_junk($db->escape($_POST['ccode']));
        $u_sstatus = remove_junk($db->escape($_POST['sstatus']));
        $u_ccreatedat = remove_junk($db->escape($_POST['ccreatedat']));


        $query  = "INSERT INTO usertable (";
        $query .=" name,email,password,code,status,created_at";
        $query .=") VALUES (";
        $query .=" '{$u_nname}','{$u_eemail}','{$u_ppass}', '{$u_ccode}', '{$u_sstatus}', '{$u_ccreatedat}'";
        $query .=")";
        $query .=" ON DUPLICATE KEY UPDATE email='{$u_eemail}'";

        if ($db->query($query)) {
            $session->msg('s',"usertable added ");
            redirect('add_user.php', false);
        } else {
            $session->msg('d',' Sorry failed to added!');
            redirect('usertable.php', false);
        }

    } else {
        $session->msg("d", $errors);
        redirect('add_user.php', false);
    }
}
?>
<?php include_once('layouts/header-sidebar.php'); ?>

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
                            <div class="input-group">
                            <input type="text" class="form-control" name="nname"
                                            placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="eemail"
                                            placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="ppass"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="ccode"
                                            placeholder="OTP Code">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="sstatus"
                                            placeholder="Status">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
 
                                        <input type="text" class="form-control" name="ccreatedat"
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

<?php include_once('layouts/main-footer.php'); ?>
