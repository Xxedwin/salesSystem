<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $productExtense = find_by_id('production_expenses',(int)$_GET['id']);
  if(!$productExtense){
    $session->msg("d","ID vacío");
    redirect('production_expenses.php');
  }
?>
<?php
  $delete_id = delete_by_id('production_expenses',(int)$productExtense['id']);
  if($delete_id){
      $session->msg("s","Gasto en producción eliminado");
      redirect('production_expenses.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('production_expenses.php');
  }
?>
