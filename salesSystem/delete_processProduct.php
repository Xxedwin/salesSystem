<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  if(isset($_POST['id'])){
    $id=$_POST['id'];        
  }
  $processProduct = find_by_id('processed_products',(int)$id);
  if(!$processProduct){
    $session->msg("d","ID vacío");
    redirect('processed_products.php');
  }
?>
<?php
  $delete_id = delete_by_id('processed_products',(int)$id);
  if($delete_id){
      $session->msg("s","Producto elaborado eliminado");
      redirect('processed_products.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('processed_products.php');
  }
?>
