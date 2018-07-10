<?php
  $page_title = 'Editar Medida';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all presentations.
  $presentation = find_by_id('presentations',(int)$_GET['id']);
  if(!$presentation){
    $session->msg("d","Missing presentation id.");
    redirect('presentation.php');
  }
?>

<?php
if(isset($_POST['edit_presentation'])){
  $req_field = array('presentation-name');
  validate_fields($req_field);
  $presentation_name = remove_junk($db->escape($_POST['presentation-name']));
  if(empty($errors)){
        $sql = "UPDATE presentations SET name='{$presentation_name}'";
       $sql .= " WHERE id='{$presentation['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Presentacion actualizada con éxito.");
       redirect('presentation.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('presentation.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('presentation.php',false);
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
           <span>Editando <?php echo remove_junk(ucfirst($presentation['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_presentation.php?id=<?php echo (int)$presentation['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="presentation-name" value="<?php echo remove_junk(ucfirst($presentation['name']));?>">
           </div>
           <button type="submit" name="edit_presentation" class="btn btn-primary">Actualizar Presentacion</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
