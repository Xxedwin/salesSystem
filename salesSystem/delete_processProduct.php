<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $processProduct = find_by_id('processed_products',(int)$_GET['id']);
  if(!$processProduct){
    $session->msg("d","ID vacío");
    redirect('processed_products.php');
  }
?>
<?php
  $delete_id = delete_by_id('processed_products',(int)$processProduct['id']);
  if($delete_id){
      $session->msg("s","Producto elaborado eliminado");
      redirect('processed_products.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('processed_products.php');
  }
?>
