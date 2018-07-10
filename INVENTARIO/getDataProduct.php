<?php  
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);  
?>

<?php $data = $_POST['valorSeleccionado'];?>

<?php 

	$productExpense= find_by_id('processed_products',(int)$data);  
	$categorie_id=$productExpense['categorie_id'];
	$media_id=$productExpense['media_id'];
	$unit=$productExpense['unit'];
	$measure_id=$productExpense['measure_id'];
	$cost_unit=$productExpense['cost_unit'];	

	$data=array($measure_id,$categorie_id,$media_id,$unit,$cost_unit);
	echo json_encode($data);
	return $data;

?>