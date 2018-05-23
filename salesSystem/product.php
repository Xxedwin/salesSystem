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
     $id   = remove_junk($db->escape($_POST['id']));
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
                <td> <?php echo remove_junk($product['name']); ?></td>
                <!-- <td class="text-center"> <?php echo remove_junk($product['mark']); ?></td> -->
                <!-- <td class="text-center"> <?php echo remove_junk($product['unit']); ?></td> -->
                <!-- <td class="text-center"> <?php echo remove_junk($product['presentation']); ?></td> -->
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['distributor']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group" style="display: flex;justify-content: space-between;">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>                     
                     <a data-toggle="modal" data-target="#exampleModal2" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon  glyphicon-trash"></span>
                    </a>
                     <a data-toggle="modal" data-target="#exampleModal1" class="btn btn-danger btn-xs"  title="Agregar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-plus"></span>
                    </a>
                  </div>
                </td>
              </tr>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-center" id="exampleModalLabel">Nombre:<?php echo remove_junk($product['name']); ?> Existencia: <?php echo remove_junk($product['quantity']); ?> </h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="post" action="product.php">
                      <div class="modal-body"> 
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Cuantos desea añadir al inventario del producto:</label>
                            <input type="text" class="form-control" name="append_quantity">
                            <input type="hidden" class="form-control" name="quantity" value=<?php echo remove_junk($product['quantity']); ?> >
                            <input type="hidden" class="form-control" name="id" value=<?php echo remove_junk($product['id']); ?> >
                          </div>   
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="append_product"  class="btn btn-primary">Guardar cambios</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-center" id="exampleModalLabel">Estás seguro que deseas eliminar el producto?</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="post" action="delete_product.php?id=<?php echo (int)$product['id'];?>">
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> 

  <script type="text/javascript">
    
      
  </script>

   
  <?php include_once('layouts/footer.php'); ?>
