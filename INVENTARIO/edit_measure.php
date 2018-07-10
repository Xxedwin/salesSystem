<?php
  $page_title = 'Editar Medida';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all measures.
  $measure = find_by_id('measures',(int)$_GET['id']);
  if(!$measure){
    $session->msg("d","Missing measure id.");
    redirect('measure.php');
  }
?>

<?php
if(isset($_POST['edit_dis'])){
  $req_field = array('measure-name');
  validate_fields($req_field);
  $dis_name = remove_junk($db->escape($_POST['measure-name']));
  if(empty($errors)){
        $sql = "UPDATE measures SET name='{$dis_name}'";
       $sql .= " WHERE id='{$measure['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Medida actualizada con éxito.");
       redirect('measure.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('measure.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('measure.php',false);
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
           <span>Editando <?php echo remove_junk(ucfirst($measure['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_measure.php?id=<?php echo (int)$measure['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="measure-name" value="<?php echo remove_junk(ucfirst($measure['name']));?>">
           </div>
           <button type="submit" name="edit_dis" class="btn btn-primary">Actualizar Medida</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
