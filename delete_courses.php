<?php
  require_once('includes/load.php');
?>
<?php
  $courses = find_by_id('courses',(int)$_GET['id']);
  if(!$courses){
    $session->msg("d","Missing Courses id.");
    redirect('courses.php');
  }
?>
<?php
  $delete_id = delete_by_id('courses',(int)$courses['id']);
  if($delete_id){
      $session->msg("s","Course deleted succesfully!");
      redirect('courses.php');
  } else {
      $session->msg("d","Failed to delete Course!");
      redirect('courses.php');
  }
?>
