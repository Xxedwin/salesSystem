<?php  
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);  
?>
<?php 
$newContent = array();
foreach($_POST as $k=>$v)
{
${$k}=$v;
$productExpense= find_by_id('production_expenses',(int)$v);  
$price=$productExpense['buy_price'];
$unit=$productExpense['unit'];
$result=(float)$price/(float)$unit;
$newContent[]=$result;			
$myJSON = json_encode($newContent);

}
echo $myJSON;

?>