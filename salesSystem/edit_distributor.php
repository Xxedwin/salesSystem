<?php
  $page_title = 'Editar distribuidora';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $distributor = find_by_id('distributors',(int)$_GET['id']);
  if(!$distributor){
    $session->msg("d","Missing distributor id.");
    redirect('distributor.php');
  }
?>

<?php
if(isset($_POST['edit_dis'])){
  $req_field = array('distributor-name');
  validate_fields($req_field);
  $dis_name = remove_junk($db->escape($_POST['distributor-name']));
  if(empty($errors)){
        $sql = "UPDATE distributors SET name='{$dis_name}'";
       $sql .= " WHERE id='{$distributor['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Distribuidora actualizada con éxito.");
       redirect('distributor.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('distributor.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('distributor.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editando <?php echo remove_junk(ucfirst($distributor['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_distributor.php?id=<?php echo (int)$distributor['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="distributor-name" value="<?php echo remove_junk(ucfirst($distributor['name']));?>">
           </div>
           <button type="submit" name="edit_dis" class="btn btn-primary">Actualizar distribuidora</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
