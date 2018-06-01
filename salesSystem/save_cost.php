<?php
  $page_title = 'Agregar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page.
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_distributors = find_all('distributors');
  $all_photo = find_all('media');

?>

<?php 
 if(isset($_POST['add_product'])){

   $req_fields = array('product-title','product-categorie','result','allBag');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));     
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_result  = remove_junk($db->escape($_POST['result']));
     $p_allBag  = remove_junk($db->escape($_POST['allBag']));     
     
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO processed_products (";
     $query .=" name,categorie_id,media_id";
     $query .=") VALUES (";
     $query .=" '{$p_name}','{$p_cat}', '{$media_id}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";    

     if($db->query($query)){

      $expense_id = id_expenses();
      $expense_id =$expense_id['id'];

      $date2    = make_date();
      $query2  = "INSERT INTO cost_product (";
      $query2 .=" expense_id,cost_unit,quantity,categorie_id,media_id";
      $query2 .=") VALUES (";
      $query2 .=" '{$expense_id}', '{$p_result}', '{$p_allBag}', '{$p_cat}', '{$media_id}'";
      $query2 .=")";
      if ($db->query($query2)) {
       $session->msg('s',"Costo agregado exitosamente. ");
       redirect('cost_unit.php', false);
      }
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('cost_unit.php', false);
     }
   } else{
     $session->msg("d", $errors);
     redirect('cost_unit.php',false);
   }
 }
?>

