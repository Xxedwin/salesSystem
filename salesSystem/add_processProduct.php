<?php
  $page_title = 'Agregar producto elaborado';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page.
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_distributors = find_all('distributors');
  $all_photo = find_all('media');
?>
<?php 
 if(isset($_POST['add_processProduct'])){
   $req_fields = array('processProduct-title','processProduct-unit','processProduct-presentation','processProduct-categorie','processProduct-quantity','buying-price', 'saleing-price' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['processProduct-title']));
     $p_unit  = remove_junk($db->escape($_POST['processProduct-unit']));
     $p_presentation  = remove_junk($db->escape($_POST['processProduct-presentation']));
     $p_cat   = remove_junk($db->escape($_POST['processProduct-categorie']));
     $p_qty   = remove_junk($db->escape($_POST['processProduct-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
     if (is_null($_POST['processProduct-photo']) || $_POST['processProduct-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['processProduct-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO processed_products (";
     $query .=" name,quantity,buy_price,sale_price,categorie_id,media_id,date,unit,presentation";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}','{$p_unit}','{$p_presentation}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Producto elaborado agregado exitosamente. ");
       redirect('processed_products.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('processed_products.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_processProduct.php',false);
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
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar producto elaborado</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_processProduct.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="processProduct-title" placeholder="Descripción">
               </div>
              </div>
              <!-- <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="processProduct-mark" placeholder="Marca">
               </div>
              </div> -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="processProduct-unit" placeholder="Unidad de medida">
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="processProduct-presentation" placeholder="Presentacion">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="processProduct-categorie">
                      <option value="">Selecciona una categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <!-- <div class="col-md-4">
                    <select class="form-control" name="processProduct-distributor">
                      <option value="">Selecciona una distribuidora</option>
                    <?php  foreach ($all_distributors as $dis): ?>
                      <option value="<?php echo (int)$dis['id'] ?>">
                        <?php echo $dis['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div> -->
                  <div class="col-md-6">
                    <select class="form-control" name="processProduct-photo">
                      <option value="">Selecciona una imagen</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                  <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="cost();" class="form-control" id="buying-price" name="buying-price" placeholder="Costo Unitario">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
                 <div class="col-md-3">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="cost();" class="form-control" id="processProduct-quantity" name="processProduct-quantity" placeholder="Cantidad">
                  </div>
                 </div>        
                 <div class="col-md-3">
                   <div class="input-group">
                     <span class="input-group-addon">                      
                      <i class="glyphicon glyphicon-usd"></i>
                     </span>                     
                     <div id="resultado" readonly class="form-control">Costo</div>                      
                  </div>
                 </div>          
                  <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="text" class="form-control" name="saleing-price" placeholder="Precio de venta">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
               </div>
              </div>
              <button type="submit" name="add_processProduct" class="btn btn-danger">Agregar producto elaborado</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function cost(){
    var num1 = document.getElementById("buying-price");
    var num2 = document.getElementById("processProduct-quantity");
    var div = document.getElementById("resultado");
    resultado = parseInt(num1.value) / parseInt(num2.value);
    div.innerHTML= resultado; 
    }
  </script>

<?php include_once('layouts/footer.php'); ?>
