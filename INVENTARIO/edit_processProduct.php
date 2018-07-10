<?php
  $page_title = 'Editar producto elaborado';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$processProduct = find_by_id('processed_products',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_distributors = find_all('distributors');
$all_photo = find_all('media');
$all_presentations = find_all('presentations');
$all_measures = find_all('measures');
if(!$processProduct){
  $session->msg("d","Missing processed product id.");
  redirect('processed_products.php');
}
?>
<?php
 if(isset($_POST['processProduct'])){
    $req_fields = array('processProduct-title','processProduct-unit','processProduct-categorie','processProduct-quantity', 'saleing-price' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['processProduct-title']));       
       $p_unit  = remove_junk($db->escape($_POST['processProduct-unit']));
       $p_presentation  = remove_junk($db->escape($_POST['processProduct-presentation']));
       $p_cat   = (int)$_POST['processProduct-categorie'];       
       $p_qty   = remove_junk($db->escape($_POST['processProduct-quantity']));       
       $p_sale  = remove_junk($db->escape($_POST['saleing-price']));           
       $p_measure   = remove_junk($db->escape($_POST['measure_id']));  
       if (is_null($_POST['processProduct-photo']) || $_POST['processProduct-photo'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['processProduct-photo']));
       }
       $query   = "UPDATE processed_products SET";
       $query  .=" name ='{$p_name}', unit ='{$p_unit}', presentation_id ='{$p_presentation}', quantity ='{$p_qty}',";
       $query  .=" sale_price ='{$p_sale}', categorie_id ='{$p_cat}',media_id='{$media_id}',measure_id='{$p_measure}'";
       $query  .=" WHERE id ='{$processProduct['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto elaborado ha sido actualizado. ");
                 redirect('processed_products.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('processed_products.php?id='.$processProduct['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_processProduct.php?id='.$processProduct['id'], false);
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
            <span>Editar producto elaborado</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
           <form method="post" action="edit_processProduct.php?id=<?php echo (int)$processProduct['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" placeholder="Descripcion" class="form-control" name="processProduct-title" value="<?php echo remove_junk($processProduct['name']);?>">
               </div>
              </div>
              
              <div class="form-group">
                <div class="row">                   
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>                      
                      <input type="text" placeholder="Unidad de medida" class="form-control" name="processProduct-unit" value="<?php echo remove_junk($processProduct['unit']);?>">
                   </div> 
                  </div>
                  <div class="col-md-8" >                    
                    <select class="form-control" name="measure_id" id="measure_id">
                    <option value="">Selecciona una medida</option>
                     <?php  foreach ($all_measures as $measure): ?>
                       <option value="<?php echo (int)$measure['id']; ?>" <?php if($processProduct['measure_id'] === $measure['id']): echo "selected"; endif; ?> >
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
                  <select class="form-control" name="processProduct-presentation">
                   <option value="">Selecciona una presentacion</option>
                  <?php  foreach ($all_presentations as $presentation): ?>
                    <option value="<?php echo (int)$presentation['id']; ?>" <?php if($processProduct['presentation_id'] === $presentation['id']): echo "selected"; endif; ?> >
                      <?php echo remove_junk($presentation['name']); ?></option>
                  <?php endforeach; ?>
                  </select>      
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="processProduct-categorie">
                    <option value="">Selecciona una categoría</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($processProduct['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="processProduct-photo">
                      <option value=""> Sin imagen</option>
                      <?php  foreach ($all_photo as $photo): ?>
                        <option value="<?php echo (int)$photo['id'];?>" <?php if($processProduct['media_id'] === $photo['id']): echo "selected"; endif; ?> >
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
                    <label for="qty">Cantidad</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="text" class="form-control" id="processProduct-quantity" name="processProduct-quantity" value="<?php echo remove_junk($processProduct['quantity']); ?>">
                   </div>
                  </div>
                 </div>
                 <div class="col-md-4">
                  <label for="qty">Precio de costo</label>
                   <div class="input-group">
                     <span class="input-group-addon">                      
                      <i class="glyphicon glyphicon-usd"></i>
                     </span>                                          
                     <input type="text" readonly class="form-control" name="result" value="<?php echo remove_junk($processProduct['cost_unit']);?>">
                  </div>
                 </div>
                  <div class="col-md-4">
                   <div class="form-group">
                     <label for="qty">Precio de venta</label>
                     <div class="input-group">
                       <span class="input-group-addon">
                         <i class="glyphicon glyphicon-usd"></i>
                       </span>
                       <input type="number" class="form-control" name="saleing-price" value="<?php echo remove_junk($processProduct['sale_price']);?>">
                       <span class="input-group-addon">.00</span>
                    </div>
                   </div>
                  </div>
               </div>
              </div>
              <button type="submit" name="processProduct" class="btn btn-danger">Actualizar</button>
          </form>
         </div>
        </div>
      </div>
  </div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript">

  </script>

<?php include_once('layouts/footer.php'); ?>
