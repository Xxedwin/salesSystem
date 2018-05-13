<?php
  $page_title = 'Lista de distribuidores';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_distributor = find_all('distributors')
?>
<?php
 if(isset($_POST['add_dis'])){
   $req_field = array('distributor-name');
   validate_fields($req_field);
   $dis_name = remove_junk($db->escape($_POST['distributor-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO distributors (name)";
      $sql .= " VALUES ('{$dis_name}')";
      if($db->query($sql)){
        $session->msg("s", "Distribuidora agregada exitosamente.");
        redirect('distributor.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar distribuidora</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="distributor.php">
            <div class="form-group">
                <input type="text" class="form-control" name="distributor-name" placeholder="Nombre de la distribuidora" required>
            </div>
            <button type="submit" name="add_dis" class="btn btn-primary">Agregar distribuidora</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de distribuidoras</span>
       </strong>
      </div>
        <div class="panel-body">
          <table id="example" class="table table-bordered table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Distribuidoras</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_distributor as $dis):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($dis['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_distributor.php?id=<?php echo (int)$dis['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_distributor.php?id=<?php echo (int)$dis['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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