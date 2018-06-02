<?php
  $page_title = 'Lista de gastos en producción';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $productExpenses = join_costProduct_table();  
  
?>
<?php  
if(isset($_POST['append_product'])){
  $req_fields = array('append_quantity','quantity');
  validate_fields($req_fields);
  if(empty($errors)){
    $p_qty   = remove_junk($db->escape($_POST['append_quantity']));
    $qty   = remove_junk($db->escape($_POST['quantity']));
    $id   = remove_junk($db->escape($_POST['idAdd']));
    $p_qty   = $p_qty + $qty;
    
    $query   = "UPDATE production_expenses SET";
    $query  .=" quantity ='{$p_qty}'";
    $query  .=" WHERE id ='{$id}'"; 
    $result = $db->query($query);
            if($result && $db->affected_rows() === 1){
              $session->msg('s',"El gasto del producto ha sido actualizado. ");
              redirect('production_expenses.php', false);
            } else {
              $session->msg('d',' Lo siento, actualización falló.');
              /*redirect('edit_product.php?id='.$product['id'], false);*/
            }
  } else{
    $session->msg("d", $errors);
    redirect('production_expenses.php',false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_cost.php" class="btn btn-primary">Agregar costo producto</a>
         </div>
        </div>
        <div class="panel-body">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th >#</th>
                <th> Imagen</th>
                <th> Descripción </th>  
                <!-- <th > Marca </th> -->
                <th > Unidad de medida </th><!-- 
                <th > Presentacion </th> -->
                <th > Categoría </th>
                <th > Costo producto </th>
                <!-- <th > Precio de compra </th>  -->               
                <!-- <th > Agregado </th> -->
                <th > Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($productExpenses as $productExpense):?>
              <tr>
                <td ><?php echo count_id();?></td>                
                 <td>
                  <?php if($productExpense['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $productExpense['image']; ?>" alt="">
                <?php endif; ?>
                </td> 
                <td> <?php echo $name=remove_junk($productExpense['name']); ?></td>
                <!-- <td > <?php echo remove_junk($productExpense['mark']); ?></td> -->
                <td > <?php echo remove_junk($productExpense['unit']); ?></td><!-- 
                <td > <?php echo remove_junk($productExpense['presentation']); ?></td> -->
                <td > <?php echo remove_junk($productExpense['categorie']); ?></td>
                <!-- <td > <?php echo $quantity=remove_junk($productExpense['quantity']); ?></td> -->
                <td > <?php echo remove_junk($productExpense['cost_unit']); ?></td>                
                <!-- <td > <?php echo read_date($productExpense['date']); ?></td> -->
                <td >
                  <div class="btn-group">
                    <a href="edit_productExpense.php?id=<?php echo $id=(int)$productExpense['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>                     
                     <a <?php echo "onClick=\"idInventory('modalInventory.php','$id')\"" ?> class="btn btn-danger btn-xs" title="Eliminar" >
                      <span class="glyphicon  glyphicon-trash" ></span>
                    </a> 
                  </div>
                </td>
              </tr>
              <div id="content"></div>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <style type="text/css">
    .close{
      margin-top: -70px;
      font-size: 38px;
    }
    .modal-footer{
      display: flex;
      justify-content: space-around;
      padding: 15px 0px 15px 0px;
    }
    .btn-group{
      display: flex;
      justify-content: space-evenly;
    }
  </style>  
  <?php include_once('layouts/footer.php'); ?>

   <script type="text/javascript">

     idInventory = function(jRuta,jid,jquantity,jname)
     {
          var number=3;
          var parametros = {
              "id" : jid,
              "quantity" : jquantity,
              "name" : jname,
              "number" : number             
          };
          
          $.ajax({
                data:  parametros,
                type: "POST",
                url: jRuta,
                 beforeSend: function () {                
                 },
                 success: function(data)
                 { 
                   
                   response = JSON.parse(data);                                                                  
                   var val=response[1];                  

                   if (val=='') {
                     $("#content").html(response[2]);     
                     $('#id').val(response[0]);
                     $("#modalDelete").modal("show");  
                     
                   }
                   else{
                       $("#content").html(response[3]);     
                     $("#quantity").val(response[0]);
                       $("#viewQuantity").html(response[0]);
                       $("#idAdd").val(response[1]);
                       $("#name").html(response[2]);                                        
                       $('#modalAdd').modal('show');                  
                   }

                 }
          });
     } 

     $('#example').DataTable({
       "language": {
         "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
     }); 
        
   </script>
