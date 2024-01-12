<?php
  require_once('includes/load.php');
?>
<?php
  $enrolled_students = find_by_id('enrolled_students',(int)$_GET['id']);
  if(!$enrolled_students){
    $session->msg("d","Missing enrolled_students id.");
    redirect('usertable.php');
  }
?>
<?php
  $delete_id = delete_by_id('enrolled_students',(int)$enrolled_students['id']);
  if($delete_id){
      $session->msg("s","Student deleted succesfully!");
      redirect('usertable.php');
  } else {
      $session->msg("d","Failed to delete Student!");
      redirect('usertable.php');
  }
?>
