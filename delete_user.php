<?php
  require_once('includes/load.php');
?>
<?php
  $usertable = find_by_id('usertable',(int)$_GET['id']);
  if(!$usertable){
    $session->msg("d","Missing usertable id.");
    redirect('usertable.php');
  }
?>
<?php
  $delete_id = delete_by_id('usertable',(int)$usertable['id']);
  if($delete_id){
      $session->msg("s","Course deleted succesfully!");
      redirect('usertable.php');
  } else {
      $session->msg("d","Failed to delete Course!");
      redirect('usertable.php');
  }
?>
