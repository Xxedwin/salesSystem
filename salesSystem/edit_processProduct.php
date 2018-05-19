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
if(!$processProduct){
  $session->msg("d","Missing processed product id.");
  redirect('processed_products.php');
}
?>
<?php
 if(isset($_POST['processProduct'])){
    $req_fields = array('processProduct-title','processProduct-mark','processProduct-unit','processProduct-presentation','processProduct-categorie','processProduct-distributor','processProduct-quantity','buying-price', 'saleing-price' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['processProduct-title']));
       $p_mark  = remove_junk($db->escape($_POST['processProduct-mark']));
       $p_unit  = remove_junk($db->escape($_POST['processProduct-unit']));
       $p_presentation  = remove_junk($db->escape($_POST['processProduct-presentation']));
       $p_cat   = (int)$_POST['processProduct-categorie'];
       $p_dis   = (int)$_POST['processProduct-distributor'];
       $p_qty   = remove_junk($db->escape($_POST['processProduct-quantity']));
       $p_buy   = remove_junk($db->escape($_POST['buying-price']));
       $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
       if (is_null($_POST['processProduct-photo']) || $_POST['processProduct-photo'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['processProduct-photo']));
       }
       $query   = "UPDATE processed_products SET";
       $query  .=" name ='{$p_name}', mark ='{$p_mark}', unit ='{$p_unit}', presentation ='{$p_presentation}', quantity ='{$p_qty}',";
       $query  .=" buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}', distributor_id ='{$p_dis}',media_id='{$media_id}'";
       $query  .=" WHERE id ='{$processProduct['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto elaborado ha sido actualizado. ");
                 redirect('processed_products.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_processProduct.php?id='.$processProduct['id'], false);
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
         <div class="col-md-7">
           <form method="post" action="edit_processProduct.php?id=<?php echo (int)$processProduct['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="processProduct-title" value="<?php echo remove_junk($processProduct['name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="processProduct-mark" value="<?php echo remove_junk($processProduct['mark']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="processProduct-unit" value="<?php echo remove_junk($processProduct['unit']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="processProduct-presentation" value="<?php echo remove_junk($processProduct['presentation']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control" name="processProduct-categorie">
                    <option value="">Selecciona una categoría</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($processProduct['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                   <div class="col-md-4">
                     <select class="form-control" name="processProduct-distributor">
                     <option value="">Selecciona una distribuidora</option>
                    <?php  foreach ($all_distributors as $dis): ?>
                      <option value="<?php echo (int)$dis['id']; ?>" <?php if($processProduct['distributor_id'] === $dis['id']): echo "selected"; endif; ?> >
                        <?php echo remove_junk($dis['name']); ?></option>
                    <?php endforeach; ?>
                  </select>
                   </div>
                  <div class="col-md-4">
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
                      <input type="number" class="form-control" name="processProduct-quantity" value="<?php echo remove_junk($processProduct['quantity']); ?>">
                   </div>
                  </div>
                 </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Precio de compra</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="buying-price" value="<?php echo remove_junk($processProduct['buy_price']);?>">
                      <span class="input-group-addon">.00</span>
                   </div>
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

<?php include_once('layouts/footer.php'); ?>
