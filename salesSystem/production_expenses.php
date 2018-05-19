<?php
  $page_title = 'Lista de gastos en producción';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $productExpenses = join_productExpense_table();
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
           <a href="add_productExpense.php" class="btn btn-primary">Agregar gasto en producción</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <!-- <th> Imagen</th> -->
                <th> Descripción </th>
                <th class="text-center" style="width: 10%;"> Marca </th>
                <th class="text-center" style="width: 10%;"> Unidad de medida </th>
                <th class="text-center" style="width: 10%;"> Presentacion </th>
                <th class="text-center" style="width: 10%;"> Categoría </th>
                <th class="text-center" style="width: 10%;"> Distribuidora </th>
                <th class="text-center" style="width: 10%;"> Stock </th>
                <th class="text-center" style="width: 10%;"> Precio de compra </th>                
                <th class="text-center" style="width: 10%;"> Agregado </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($productExpenses as $productExpense):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <!-- <td>
                  <?php if($productExpense['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $productExpense['image']; ?>" alt="">
                <?php endif; ?>
                </td> -->
                <td> <?php echo remove_junk($productExpense['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($productExpense['mark']); ?></td>
                <td class="text-center"> <?php echo remove_junk($productExpense['unit']); ?></td>
                <td class="text-center"> <?php echo remove_junk($productExpense['presentation']); ?></td>
                <td class="text-center"> <?php echo remove_junk($productExpense['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($productExpense['distributor']); ?></td>
                <td class="text-center"> <?php echo remove_junk($productExpense['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($productExpense['buy_price']); ?></td>                
                <td class="text-center"> <?php echo read_date($productExpense['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_productExpense.php?id=<?php echo (int)$productExpense['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_productExpense.php?id=<?php echo (int)$productExpense['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
