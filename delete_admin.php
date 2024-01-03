<?php
  require_once('includes/load.php');
?>
<?php
  $admin = find_by_id('admin',(int)$_GET['id']);
  if(!$admin){
    $session->msg("d","Missing admin id.");
    redirect('admin_table.php');
  }
?>
<?php
  $delete_id = delete_by_id('admin',(int)$admin['id']);
  if($delete_id){
      $session->msg("s","Course deleted succesfully!");
      redirect('admin_table.php');
  } else {
      $session->msg("d","Failed to delete Course!");
      redirect('admin_table.php');
  }
?>
