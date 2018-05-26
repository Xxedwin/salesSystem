<?php
  $page_title = 'Editar gasto en producción';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$productExpense = find_by_id('production_expenses',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_distributors = find_all('distributors');
$all_photo = find_all('media');
$all_measures = find_all('measures');
if(!$productExpense){
  $session->msg("d","Missing product expenses id.");
  redirect('production_expenses.php');
}
?>
<?php
 if(isset($_POST['productExpense'])){
    $req_fields = array('productExpense-title','productExpense-unit','productExpense-categorie','productExpense-quantity','buying-price' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['productExpense-title']));
       $p_mark  = remove_junk($db->escape($_POST['productExpense-mark']));
       $p_unit  = remove_junk($db->escape($_POST['productExpense-unit']));
       $p_presentation  = remove_junk($db->escape($_POST['productExpense-presentation']));
       $p_cat   = (int)$_POST['productExpense-categorie'];
       $p_dis   = (int)$_POST['productExpense-distributor'];
       $p_qty   = remove_junk($db->escape($_POST['productExpense-quantity']));
       $p_buy   = remove_junk($db->escape($_POST['buying-price']));       
       if (is_null($_POST['productExpense-photo']) || $_POST['productExpense-photo'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['productExpense-photo']));
       }
       $query   = "UPDATE production_expenses SET";
       $query  .=" name ='{$p_name}', mark ='{$p_mark}', unit ='{$p_unit}', presentation ='{$p_presentation}', quantity ='{$p_qty}',";
       $query  .=" buy_price ='{$p_buy}', categorie_id ='{$p_cat}', distributor_id ='{$p_dis}',media_id='{$media_id}'";
       $query  .=" WHERE id ='{$productExpense['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto ha sido actualizado. ");
                 redirect('production_expenses.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_productExpense.php?id='.$productExpense['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_productExpense.php?id='.$productExpense['id'], false);
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Editar gasto en producción</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
           <form method="post" action="edit_productExpense.php?id=<?php echo (int)$productExpense['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" placeholder="Descripcion" class="form-control" name="productExpense-title" value="<?php echo remove_junk($productExpense['name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" placeholder="Mark" class="form-control" name="productExpense-mark" value="<?php echo remove_junk($productExpense['mark']);?>">
               </div>
              </div>              
              <div class="form-group">
                <div class="row">                   
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>                      
                      <input type="text" placeholder="Unidad de medida" class="form-control" name="productExpense-unit" value="<?php echo remove_junk($productExpense['unit']);?>">
                   </div> 
                  </div>
                  <div class="col-md-8" >                    
                    <select class="form-control" name="measure_id" id="measure_id">
                    <option value="">Selecciona una medida</option>
                     <?php  foreach ($all_measures as $measure): ?>
                       <option value="<?php echo (int)$measure['id']; ?>" <?php if($productExpense['measure_id'] === $measure['id']): echo "selected"; endif; ?> >
                         <?php echo remove_junk($measure['name']); ?></option>
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
                  <input type="text"  placeholder="Presentacion" class="form-control" name="productExpense-presentation" value="<?php echo remove_junk($productExpense['presentation']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control" name="productExpense-categorie">
                    <option value="">Selecciona una categoría</option>
                     <?php  foreach ($all_categories as $cat): ?>
                       <option value="<?php echo (int)$cat['id']; ?>" <?php if($productExpense['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                         <?php echo remove_junk($cat['name']); ?></option>
                     <?php endforeach; ?>
                    </select>
                  </div>
                   <div class="col-md-4">
                     <select class="form-control" name="productExpense-distributor">
                     <option value="">Selecciona una distribuidora</option>
                    <?php  foreach ($all_distributors as $dis): ?>
                      <option value="<?php echo (int)$dis['id']; ?>" <?php if($productExpense['distributor_id'] === $dis['id']): echo "selected"; endif; ?> >
                        <?php echo remove_junk($dis['name']); ?></option>
                    <?php endforeach; ?>
                  </select>
                   </div>
                  <div class="col-md-4">
                    <select class="form-control" name="productExpense-photo">
                      <option value=""> Sin imagen</option>
                      <?php  foreach ($all_photo as $photo): ?>
                        <option value="<?php echo (int)$photo['id'];?>" <?php if($productExpense['media_id'] === $photo['id']): echo "selected"; endif; ?> >
                          <?php echo $photo['file_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                <div class="col-md-4">
                 <div class="form-group">
                   <label for="qty">Precio de compra</label>
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="text" class="form-control" id="buying-price" name="buying-price" value="<?php echo remove_junk($productExpense['buy_price']);?>">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Cantidad</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="text" class="form-control" id="productExpense-quantity" name="productExpense-quantity" value="<?php echo remove_junk($productExpense['quantity']); ?>">
                   </div>
                  </div>
                 </div>
                 <div class="col-md-4">
                  <label for="qty">Precio de costo</label>
                   <div class="input-group">
                     <span class="input-group-addon">                      
                      <i class="glyphicon glyphicon-usd"></i>
                     </span>                     
                     <div id="result" readonly class="form-control">Costo</div>                      
                  </div>
                 </div>                                   
               </div>
              </div>
              <button type="submit" name="productExpense" class="btn btn-danger">Actualizar</button>
          </form>
         </div>
        </div>
      </div>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var num1 = document.getElementById("buying-price");
      var num2 = document.getElementById("productExpense-quantity");
      var div = document.getElementById("result");
      result = parseFloat(num1.value) / parseFloat(num2.value);    
      result = Number(result.toFixed(2));
      div.innerHTML= result; 
    });

  </script>

<?php include_once('layouts/footer.php'); ?>
