<?php
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $products = join_product_table();
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
    
    $query   = "UPDATE products SET";
    $query  .=" quantity ='{$p_qty}'";
    $query  .=" WHERE id ='{$id}'"; 
    $result = $db->query($query);
            if($result && $db->affected_rows() === 1){
              $session->msg('s',"Producto ha sido actualizado. ");
              redirect('product.php', false);
            } else {
              $session->msg('d',' Lo siento, actualización falló.');
              /*redirect('edit_product.php?id='.$product['id'], false);*/
            }
  } else{
    $session->msg("d", $errors);
    redirect('product.php',false);
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
           <a href="add_product.php" class="btn btn-primary">Agregar producto</a>
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
                <!-- <th class="text-center" style="width: 10%;"> Unidad de medida </th> -->
                <!-- <th class="text-center" style="width: 10%;"> Presentacion </th> -->
                <th class="text-center" style="width: 10%;"> Categoría </th>
                <th class="text-center" style="width: 10%;"> Distribuidora </th>
                <th class="text-center" style="width: 10%;"> Stock </th>
                <th class="text-center" style="width: 10%;"> Precio de compra </th>
                <th class="text-center" style="width: 10%;"> Precio de venta </th>
                <th class="text-center" style="width: 10%;"> Agregado </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <!-- <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td> -->
                <td> <?php echo $name=remove_junk($product['name']); ?></td>
                <!-- <td class="text-center"> <?php echo remove_junk($product['mark']); ?></td> -->
                <!-- <td class="text-center"> <?php echo remove_junk($product['unit']); ?></td> -->
                <!-- <td class="text-center"> <?php echo remove_junk($product['presentation']); ?></td> -->
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['distributor']); ?></td>
                <td class="text-center"> <?php echo $quantity=remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group" >
                    <a href="edit_product.php?id=<?php echo $id=(int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>                     
                     <a  <?php echo "onClick=\"idInventory('modalInventory.php','$id')\"" ?> class="btn btn-danger btn-xs" title="Eliminar" >
                      <span class="glyphicon  glyphicon-trash"></span>
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

    idInventory = function(jRuta,jid,jquantity,jname)
    {
        var number=1;
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
           
  </script>

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
      justify-content: 
      space-between;      

    }
  </style>

  <?php include_once('layouts/footer.php'); ?>
