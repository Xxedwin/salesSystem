<?php
  $page_title = 'Agregar gasto en producción';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page.
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_distributors = find_all('distributors');
  $all_photo = find_all('media');
?>
<?php 
 if(isset($_POST['add_productExpense'])){
   $req_fields = array('productExpense-title','productExpense-mark','productExpense-unit','productExpense-presentation','productExpense-categorie','productExpense-distributor','productExpense-quantity','buying-price' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['productExpense-title']));
     $p_mark  = remove_junk($db->escape($_POST['productExpense-mark']));
     $p_unit  = remove_junk($db->escape($_POST['productExpense-unit']));
     $p_presentation  = remove_junk($db->escape($_POST['productExpense-presentation']));
     $p_cat   = remove_junk($db->escape($_POST['productExpense-categorie']));
     $p_dis   = remove_junk($db->escape($_POST['productExpense-distributor']));
     $p_qty   = remove_junk($db->escape($_POST['productExpense-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));     
     if (is_null($_POST['productExpense-photo']) || $_POST['productExpense-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['productExpense-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO production_expenses (";
     $query .=" name,quantity,buy_price,categorie_id,distributor_id,media_id,date,mark,unit,presentation";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_cat}', '{$p_dis}', '{$media_id}', '{$date}','{$p_mark}','{$p_unit}','{$p_presentation}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Gasto en producción agregado exitosamente. ");
       redirect('add_productExpense.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('production_expenses.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_productExpense.php',false);
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
            <span>Agregar gasto en producción</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_productExpense.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="productExpense-title" placeholder="Descripción">
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="productExpense-mark" placeholder="Marca">
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="productExpense-unit" placeholder="Unidad de medida">
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="productExpense-presentation" placeholder="Presentacion">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control" name="productExpense-categorie">
                      <option value="">Selecciona una categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" name="productExpense-distributor">
                      <option value="">Selecciona una distribuidora</option>
                    <?php  foreach ($all_distributors as $dis): ?>
                      <option value="<?php echo (int)$dis['id'] ?>">
                        <?php echo $dis['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" name="productExpense-photo">
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
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="cost();" class="form-control" id="buying-price" name="buying-price" placeholder="Precio de compra">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="text" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="cost();" class="form-control" id="productExpense-quantity" name="productExpense-quantity" placeholder="Cantidad">
                  </div>
                 </div>        
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">                      
                      <i class="glyphicon glyphicon-usd"></i>
                     </span>                     
                     <div id="resultado" readonly class="form-control">Costo</div>                      
                  </div>
                 </div>                            
               </div>
              </div>
              <button type="submit" name="add_productExpense" class="btn btn-danger">Agregar gasto en producción</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function cost(){
    var num1 = document.getElementById("buying-price");
    var num2 = document.getElementById("productExpense-quantity");
    var div = document.getElementById("resultado");
    resultado = parseInt(num1.value) / parseInt(num2.value);
    div.innerHTML= resultado; 
    }
  </script>

<?php include_once('layouts/footer.php'); ?>
