<?php  
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);  
?>

<?php $data = $_POST['valorSeleccionado'];?>

<?php 
	if (strlen($data)<4){
		$productExpense= find_by_id('production_expenses',(int)$data);  
		$productExpense=$productExpense['measure_id'];
		$productExpenses = find_by_id('measures',(int)$productExpense);
		echo $productExpenses['name'];			
	}else{
		echo "<div style='text-align: center;'>";	
		echo "<img class='img-avatar img-circle' src='uploads/products/".$data."' alt='' style='width: 250px;height: 240px;'>";
		echo "</div>";	
	}
?>