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

   $req_fields = array('product-title','product-categorie','product-unit','measure_id','result','allBag');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));     
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_unit   = remove_junk($db->escape($_POST['product-unit']));
     $p_pre   = remove_junk($db->escape($_POST['product-presentation']));   
     $p_mea   = remove_junk($db->escape($_POST['measure_id']));            
     $p_result  = remove_junk($db->escape($_POST['result']));
     $p_productTotalUnit  = remove_junk($db->escape($_POST['allBag']));     
     
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }

     /*$date2    = make_date();
     $query2  = "INSERT INTO cost_product (";
     $query2 .=" cost_unit,quantity";
     $query2 .=") VALUES (";
     $query2 .=" '{$p_result}', '{$p_allBag}'";
     $query2 .=")";*/
        
     /*if($db->query($query2)){*/

/*      $cost_id = id_cost();
      $cost_id =$cost_id['id'];*/

      $date    = make_date();
      $query  = "INSERT INTO processed_products (";
      $query .=" name,categorie_id,media_id,date,unit,presentation_id,measure_id,cost_unit,productTotalUnit";
      $query .=") VALUES (";
      $query .=" '{$p_name}','{$p_cat}', '{$media_id}', '{$date}', '{$p_unit}', '{$p_pre}', '{$p_mea}', '{$p_result}', '{$p_productTotalUnit}'";
      $query .=")";
      $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'"; 

      if ($db->query($query)) {
       $session->msg('s',"Costo agregado exitosamente. ");
       redirect('cost_unit.php', false);
      }else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_cost.php', false);
      }
/*     } */
   } else{
     $session->msg("d", $errors);
     redirect('add_cost.php',false);
   }
 }

?>

