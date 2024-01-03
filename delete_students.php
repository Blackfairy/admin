<?php
  require_once('includes/load.php');
?>
<?php
  $students = find_by_id('students',(int)$_GET['id']);
  if(!$students){
    $session->msg("d","Missing students id.");
    redirect('students_table.php');
  }
?>
<?php
  $delete_id = delete_by_id('students',(int)$students['id']);
  if($delete_id){
      $session->msg("s","Course deleted succesfully!");
      redirect('students_table.php');
  } else {
      $session->msg("d","Failed to delete Course!");
      redirect('students_table.php');
  }
?>
