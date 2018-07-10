<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  if(isset($_POST['id'])){
    $id=$_POST['id'];        
  }

  $product = find_by_id('processed_products',(int)$id);
  $id_cost=$product['cost_id']; 
  if(!$product){
    $session->msg("d","ID vacío");
    redirect('cost_unit.php');
  }
?>
<?php
  $delete_id = delete_by_id('processed_products',(int)$id);  
  $deleteCostId = delete_by_id('cost_product',(int)$id_cost);

  if($delete_id){
      $session->msg("s","Costo producto eliminado");
      redirect('cost_unit.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('cost_unit.php');
  }
?>
