<?php
  $page_title = 'Lista de productos elaborados';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $processed_products = join_processProduct_table();
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
           <a href="add_processProduct.php" class="btn btn-primary">Agregar producto elaborado</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <!-- <th> Imagen</th> -->
                <th> Descripción </th>
                <!-- <th class="text-center" style="width: 10%;"> Marca </th> -->
                <th class="text-center" style="width: 10%;"> Unidad de medida </th>
                <th class="text-center" style="width: 10%;"> Presentacion </th>
                <th class="text-center" style="width: 10%;"> Categoría </th>
                <!-- <th class="text-center" style="width: 10%;"> Distribuidora </th> -->
                <th class="text-center" style="width: 10%;"> Stock </th>
                <th class="text-center" style="width: 10%;"> Costo Unitario </th>
                <th class="text-center" style="width: 10%;"> Precio de venta </th>
                <th class="text-center" style="width: 10%;"> Agregado </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($processed_products as $processed_product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <?php $id=$processed_product['id']; ?>
                <?php $quantity=$processed_product['quantity']; ?>                  
                <?php $name=$processed_product['name']; ?> 
                <?php $process='true'; ?>   
                <!-- <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td> -->
                <td> <?php echo remove_junk($processed_product['name']); ?></td>
                <!-- <td class="text-center"> <?php echo remove_junk($processed_product['mark']); ?></td> -->
                <td class="text-center"> <?php echo remove_junk($processed_product['unit']); ?></td>
                <td class="text-center"> <?php echo remove_junk($processed_product['presentation']); ?></td>
                <td class="text-center"> <?php echo remove_junk($processed_product['categorie']); ?></td>
               <!--  <td class="text-center"> <?php echo remove_junk($processed_product['distributor']); ?></td> -->
                <td class="text-center"> <?php echo remove_junk($processed_product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($processed_product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($processed_product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($processed_product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_processProduct.php?id=<?php echo (int)$processed_product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <!-- <a href="delete_processProduct.php?id=<?php echo (int)$processed_product['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a> -->
                     <a <?php echo "onClick=\"idInventory('modalInventory.php','$id','$process')\"" ?> class="btn btn-danger btn-xs" title="Eliminar" >
                      <span class="glyphicon  glyphicon-trash" ></span>
                    </a> 
                    <a <?php echo "onClick=\"idInventory('modalInventory.php','$id','$quantity','$name')\"" ?> class="btn btn-danger btn-xs"  title="Agregar">
                      <span class="glyphicon glyphicon-plus"></span>
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

  <script type="text/javascript">

    /*function cambiarAccion(url) {
    document.getElementById("miFormulario").action = url;
    }*/

    idInventory = function(jRuta,jid,jquantity,jname)
    {

         var parametros = {
             "id" : jid,
             "quantity" : jquantity,
             "name" : jname
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
    

       
  </script>

  <style type="text/css">
    .close{
      margin-top: -50px;
      font-size: 38px;
    }
    .modal-footer{
      display: flex;
      justify-content: space-around;
      padding: 15px 0px 15px 0px;
    }
    .btn-group{
      display: flex;
      justify-content: 
      space-between;      

    }
  </style>
  <?php include_once('layouts/footer.php'); ?>
