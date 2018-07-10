<?php
  $page_title = 'Agregar producto elaborado';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page.
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_distributors = find_all('distributors');
  $all_photo = find_all('media');  
  $all_measures = find_all('measures');
  $all_presentations = find_all('presentations');
  $all_products = findAllProcessed('processed_products');
?>
<?php 
 if(isset($_POST['add_processProduct'])){
   $req_fields = array('processProduct-title','processProduct-unit','processProduct-categorie','processProduct-quantity','saleing-price' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_id  = remove_junk($db->escape($_POST['processProduct-title']));
     $p_unit  = remove_junk($db->escape($_POST['processProduct-unit']));
     $p_pre  = remove_junk($db->escape($_POST['processProduct-presentation']));
     $p_cat   = remove_junk($db->escape($_POST['processProduct-categorie']));
     $p_qty   = remove_junk($db->escape($_POST['processProduct-quantity']));     
     $p_result  = remove_junk($db->escape($_POST['result']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
     $p_mea   = remove_junk($db->escape($_POST['measure_id']));   
     if (is_null($_POST['processProduct-photo']) || $_POST['processProduct-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['processProduct-photo']));
     }

     $query   = "UPDATE processed_products SET";
     $query  .=" quantity='{$p_qty}',unit ='{$p_unit}', presentation_id ='{$p_pre}',";
     $query  .=" sale_price ='{$p_sale}',categorie_id ='{$p_cat}',media_id='{$media_id}',measure_id='{$p_mea}',cost_unit='{$p_result}'";
     $query  .=" WHERE id ='{$p_id}'";
     $result = $db->query($query);
     if($result && $db->affected_rows() === 1){
       $session->msg('s',"El producto elaborado ha sido actualizado. ");
       redirect('processed_products.php', false);
     } else {
       $session->msg('d',' Lo siento, actualización falló.');
       redirect('add_processedProduct.php?id='.$p_id, false);
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
          <form method="post" action="add_processProduct.php">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span> 
                  <select class="form-control" required onchange="redireccionar(this);" name="processProduct-title" id="processProduct-title">
                    <option value="">Selecciona el producto</option>
                  <?php  foreach ($all_products as $product): ?>
                    <option value="<?php echo (int)$product['id'] ?>">
                      <?php echo $product['name'] ?></option>
                  <?php endforeach; ?>
                  </select>                                   
               </div>
              </div>     
              <div class="form-group">
                <div class="row">                   
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>
                      <input type="text" class="form-control" name="processProduct-unit" id="processProduct-unit" placeholder="Unidad de medida">
                   </div> 
                  </div>
                  <div class="col-md-8" >
                    <select class="form-control" name="measure_id" id="measure_id">
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
                  <select class="form-control" name="processProduct-presentation" id="processProduct-presentation">
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
                  <div class="col-md-6">
                    <select class="form-control" name="processProduct-categorie" id="processProduct-categorie">
                      <option value="">Selecciona una categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="processProduct-photo" id="processProduct-photo">
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
                  <label for="qty">Cantidad inicial</label>
                   <div class="input-group">                    
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="text" required class="form-control" id="processProduct-quantity" name="processProduct-quantity" placeholder="Cantidad inicial">
                  </div>
                 </div>        
                 <div class="col-md-4">
                  <label for="qty">Precio de costo</label>
                   <div class="input-group">                    
                     <span class="input-group-addon">                      
                      <i class="glyphicon glyphicon-usd"></i>
                     </span>                                          
                     <input type="text" readonly class="form-control" name="result" id="result">                  

                  </div>
                 </div>          
                  <div class="col-md-4">
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
              <button type="submit" name="add_processProduct" class="btn btn-danger">Agregar producto elaborado</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function redireccionar(obj) {                 
      var valorSeleccionado =  document.getElementById("processProduct-title").value;          

      if ( valorSeleccionado != "") {  

        $.post("getDataProduct.php",{ 'valorSeleccionado': valorSeleccionado }, function(data){
            response = JSON.parse(data);                                                                  
              $('#measure_id').val(response[0]);
              $('#processProduct-categorie').val(response[1]);
              $('#processProduct-photo').val(response[2]);
              $('#processProduct-unit').val(response[3]);
              $('#result').val(response[4]);              
             
        }); 
      }
             
    } 
  </script>

<?php include_once('layouts/footer.php'); ?>
