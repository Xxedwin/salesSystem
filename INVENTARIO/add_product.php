<?php
  $page_title = 'Agregar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page.
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_distributors = find_all('distributors');
  $all_photo = find_all('media');    
  $all_measures = find_all('measures');
  $all_presentations = find_all('presentations');
?>
<?php 
 if(isset($_POST['add_product'])){
   $req_fields = array('product-title','product-unit','product-categorie','product-quantity','buying-price', 'saleing-price','measure_id' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_mark  = remove_junk($db->escape($_POST['product-mark']));
     $p_unit  = remove_junk($db->escape($_POST['product-unit']));
     $p_presentation  = remove_junk($db->escape($_POST['product-presentation']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_dis   = remove_junk($db->escape($_POST['product-distributor']));
     $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));     
     $p_measure   = remove_junk($db->escape($_POST['measure_id']));   
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .=" name,quantity,buy_price,sale_price,categorie_id,distributor_id,media_id,date,mark,unit,presentation_id,measure_id";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$p_dis}', '{$media_id}', '{$date}','{$p_mark}','{$p_unit}','{$p_presentation}', '{$p_measure}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Producto agregado exitosamente. ");
       redirect('product.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
            <span>Agregar producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" required class="form-control" name="product-title" placeholder="Descripción">
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-mark" placeholder="Marca">
               </div>
              </div>
              <div class="form-group">
                <div class="row">                   
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>
                      <input type="text" required class="form-control" name="product-unit" placeholder="Unidad de medida">
                   </div> 
                  </div>
                  <div class="col-md-8" >
                    <select class="form-control" required name="measure_id" id="measure_id">
                      <option value="">Selecciona la medida</option>
                    <?php  foreach ($all_measures as $measure): ?>
                      <option value="<?php echo (int)$measure['id'] ?>">
                        <?php echo $measure['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>  
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <select class="form-control" name="product-presentation">
                    <option value="">Selecciona una presentacion</option>
                  <?php  foreach ($all_presentations as $presentation): ?>
                    <option value="<?php echo (int)$presentation['id'] ?>">
                      <?php echo $presentation['name'] ?></option>
                  <?php endforeach; ?>
                  </select>
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control" required name="product-categorie">
                      <option value="">Selecciona una categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" name="product-distributor">
                      <option value="">Selecciona una distribuidora</option>
                    <?php  foreach ($all_distributors as $dis): ?>
                      <option value="<?php echo (int)$dis['id'] ?>">
                        <?php echo $dis['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" name="product-photo">
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
                    <label for="qty">Precio de compra</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="text" required onblur="if(this.value == ''){this.value='0'}"  onKeyUp="cost();" class="form-control" id="buying-price" name="buying-price" placeholder="Precio de compra">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
                 <div class="col-md-3">
                  <label for="qty">Cantidad inicial</label>
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="text" required onblur="if(this.value == ''){this.value='0'}"  onKeyUp="cost();" class="form-control" id="product-quantity" name="product-quantity" placeholder="Cantidad inicial">
                  </div>
                 </div>        
                 <div class="col-md-3">
                  <label for="qty">Precio de costo</label>
                   <div class="input-group">
                     <span class="input-group-addon">                      
                      <i class="glyphicon glyphicon-usd"></i>
                     </span>                     
                     <div id="result" readonly class="form-control">Costo</div>                      
                  </div>
                 </div>          
                  <div class="col-md-3">
                    <label for="qty">Precio de venta</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="text" required class="form-control" name="saleing-price" placeholder="Precio de venta">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
               </div>
              </div>
              <button type="submit" name="add_product" class="btn btn-danger">Agregar producto</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function cost(){
    var num1 = document.getElementById("buying-price");
    var num2 = document.getElementById("product-quantity");
    var div = document.getElementById("result");
    result = parseFloat(num1.value) / parseFloat(num2.value);    
    result = Number(result.toFixed(2));
    div.innerHTML= result; 
    }
  </script>

<?php include_once('layouts/footer.php'); ?>
