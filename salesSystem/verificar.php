<?php  
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);  
?>
<?php 
/*$allBag = $_POST['allBag'];*/
$allBag = isset($_POST['allBag']) ? $_POST['allBag'] : '';
echo $allBag;

?>