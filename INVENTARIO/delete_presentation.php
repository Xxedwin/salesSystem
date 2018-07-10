<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $presentation = find_by_id('presentations',(int)$_GET['id']);
  if(!$presentation){
    $session->msg("d","ID de la Presentacion falta.");
    redirect('presentation.php');
  }
?>
<?php
  $delete_id = delete_by_id('presentations',(int)$presentation['id']);
  if($delete_id){
      $session->msg("s","Presentacion eliminada");
      redirect('presentation.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('presentation.php');
  }
?>
