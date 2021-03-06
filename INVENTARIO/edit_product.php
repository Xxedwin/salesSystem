<?php
  $page_title = 'Editar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$product = find_by_id('products',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_distributors = find_all('distributors');
$all_photo = find_all('media');
$all_measures = find_all('measures');
$all_presentations = find_all('presentations');

if(!$product){
  $session->msg("d","Missing product id.");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['product'])){
    $req_fields = array('product-title','product-unit','product-categorie','product-quantity','buying-price', 'saleing-price' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['product-title']));
       $p_mark  = remove_junk($db->escape($_POST['product-mark']));
       $p_unit  = remove_junk($db->escape($_POST['product-unit']));
       $p_presentation  = remove_junk($db->escape($_POST['product-presentation']));
       $p_cat   = (int)$_POST['product-categorie'];
       $p_dis   = (int)$_POST['product-distributor'];
       $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
       $p_buy   = remove_junk($db->escape($_POST['buying-price']));
       $p_sale  = remove_junk($db->escape($_POST['saleing-price']));          
       $p_measure   = remove_junk($db->escape($_POST['measure_id'])); 
       if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['product-photo']));
       }
       $query   = "UPDATE products SET";
       $query  .=" name ='{$p_name}', mark ='{$p_mark}', unit ='{$p_unit}', presentation_id ='{$p_presentation}', quantity ='{$p_qty}',";
       $query  .=" buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}', distributor_id ='{$p_dis}',media_id='{$media_id}',measure_id='{$p_measure}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto ha sido actualizado. ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['id'], false);
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
            <span>Editar producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" placeholder="Descripcion" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" placeholder="Marca" class="form-control" name="product-mark" value="<?php echo remove_junk($product['mark']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">                   
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>                      
                      <input type="text" placeholder="Unidad de medida" class="form-control" name="product-unit" value="<?php echo remove_junk($product['unit']);?>">
                   </div> 
                  </div>
                  <div class="col-md-8" >                    
                    <select class="form-control" name="measure_id" id="measure_id">
                    <option value="">Selecciona una medida</option>
                     <?php  foreach ($all_measures as $measure): ?>
                       <option value="<?php echo (int)$measure['id']; ?>" <?php if($product['measure_id'] === $measure['id']): echo "selected"; endif; ?> >
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
                  <select class="form-control" name="product-presentation">
                   <option value="">Selecciona una presentacion</option>
                  <?php  foreach ($all_presentations as $presentation): ?>
                    <option value="<?php echo (int)$presentation['id']; ?>" <?php if($product['presentation_id'] === $presentation['id']): echo "selected"; endif; ?> >
                      <?php echo remove_junk($presentation['name']); ?></option>
                  <?php endforeach; ?>
                  </select>      
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control" name="product-categorie">
                    <option value="">Selecciona una categoría</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                   <div class="col-md-4">
                     <select class="form-control" name="product-distributor">
                     <option value="">Selecciona una distribuidora</option>
                    <?php  foreach ($all_distributors as $dis): ?>
                      <option value="<?php echo (int)$dis['id']; ?>" <?php if($product['distributor_id'] === $dis['id']): echo "selected"; endif; ?> >
                        <?php echo remove_junk($dis['name']); ?></option>
                    <?php endforeach; ?>
                  </select>
                   </div>
                  <div class="col-md-4">
                    <select class="form-control" name="product-photo">
                      <option value=""> Sin imagen</option>
                      <?php  foreach ($all_photo as $photo): ?>
                        <option value="<?php echo (int)$photo['id'];?>" <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?> >
                          <?php echo $photo['file_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                <div class="col-md-3">
                 <div class="form-group">
                   <label for="qty">Precio de compra</label>
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="text" class="form-control" id="buying-price" name="buying-price" value="<?php echo remove_junk($product['buy_price']);?>">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                </div>
                 <div class="col-md-3">
                  <div class="form-group">
                    <label for="qty">Cantidad</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="text" class="form-control" id="product-quantity" name="product-quantity" value="<?php echo remove_junk($product['quantity']); ?>">
                   </div>
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
                   <div class="form-group">
                     <label for="qty">Precio de venta</label>
                     <div class="input-group">
                       <span class="input-group-addon">
                         <i class="glyphicon glyphicon-usd"></i>
                       </span>
                       <input type="text" class="form-control" name="saleing-price" value="<?php echo remove_junk($product['sale_price']);?>">
                       <span class="input-group-addon">.00</span>
                    </div>
                   </div>
                  </div>
               </div>
              </div>
              <button type="submit" name="product" class="btn btn-danger">Actualizar</button>
          </form>
         </div>
        </div>
      </div>
  </div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var num1 = document.getElementById("buying-price");
      var num2 = document.getElementById("product-quantity");
      var div = document.getElementById("result");
      result = parseFloat(num1.value) / parseFloat(num2.value);    
      result = Number(result.toFixed(2));
      div.innerHTML= result; 
    });

  </script>

<?php include_once('layouts/footer.php'); ?>
