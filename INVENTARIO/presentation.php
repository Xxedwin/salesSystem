<?php
  $page_title = 'Lista de medida';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $presentations = find_all('presentations')
?>
<?php
 if(isset($_POST['add_presentation'])){
   $req_field = array('presentation-name');
   validate_fields($req_field);
   $presentation_name = remove_junk($db->escape($_POST['presentation-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO presentations (name)";
      $sql .= " VALUES ('{$presentation_name}')";
      if($db->query($sql)){
        $session->msg("s", "Presentacion agregada exitosamente.");
        redirect('presentation.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Presentacion</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="presentation.php">
            <div class="form-group">
                <input type="text" class="form-control" name="presentation-name" placeholder="Nombre de la presentacion" required>
            </div>
            <button type="submit" name="add_presentation" class="btn btn-primary">Agregar Presentacion</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de presentaciones</span>
       </strong>
      </div>
        <div class="panel-body">
          <table id="example" class="table table-bordered table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Presentaciones</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($presentations as $presentation):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($presentation['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_presentation.php?id=<?php echo (int)$presentation['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_presentation.php?id=<?php echo (int)$presentation['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>
                    <td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
              
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
  <script language="javascript">
/*  $(document).ready(function() {
    var oTable = $('#example').dataTable({   "bSort": false,
      "bPaginate": true});
  });*/
  $('#example').DataTable();
  </script>  