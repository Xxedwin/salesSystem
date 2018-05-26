<?php
  $page_title = 'Costo Unitario';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page.
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_distributors = find_all('distributors');
  $all_photo = find_all('media');
  $all_expenses = find_all('production_expenses');
  $all_measures = find_all('measures');
?>
<?php 
 if(isset($_POST['add_product'])){
   $req_fields = array('product-title','product-unit','product-categorie','product-quantity','buying-price', 'saleing-price' );
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
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .=" name,quantity,buy_price,sale_price,categorie_id,distributor_id,media_id,date,mark,unit,presentation";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$p_dis}', '{$media_id}', '{$date}','{$p_mark}','{$p_unit}','{$p_presentation}'";
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
  <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar costo del producto</span>
         </strong>
        </div>
        <div class="panel-body" style="padding: 15px 0px 15px 0px;">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" id="product-title" placeholder="Descripción">
               </div>
              </div>              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <select onchange="redireccionar2(this);" class="form-control" name="product-categorie">
                      <option value="">Selecciona una categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>                                   
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <select onchange="redireccionar(this);" class="form-control" name="product-photo">
                      <option value="">Selecciona una imagen</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>  
                </div>
              </div>              
              <div class="panel-heading">
                <strong>
                  <span class="glyphicon glyphicon-th"></span>
                  <span>AGREGAR INSUMOS:</span>
               </strong>
              </div>
              <div class="form-group">
               <div class="row clonedInput " id="input1" style="margin-bottom:4px;">
                  <div class="col-md-6" >
                    <select onchange="redireccionar(this);" class="form-control">
                      <option value="">Selecciona un insumo</option>
                    <?php  foreach ($all_expenses as $expense): ?>
                      <option value="<?php echo (int)$expense['id'] ?>">
                        <?php echo $expense['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>                                                   
                  <div class="col-md-6" >
                    <div class="input-group" >
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-cutlery"></i>
                      </span>
                      <div style="display:flex;">
                        <input type="text" class="form-control" placeholder="Unidad">
                        <input type="text" id="aqui" disabled class="form-control"                          
                       >  
                      </div>                      
                      
                   </div>
                  </div>
              </div>
                <!-- <div id="input1" style="margin-bottom:4px;" class="clonedInput">
                    Name: <input type="text" name="name1" id="name1" />
                </div> -->
                
                <div style="display: flex;justify-content: space-evenly;margin-top: 4%;">
                    <input type="button" id="btnAdd" class="btn btn-primary"  value="Más insumos" title="Agregar" style="font-size: 120%;" />                                  
                    <input type="button" id="btnDel" class="btn btn-primary"  value="Menos insumos" title="Quitar" style="font-size: 120%;" />                     
                </div>

               </div>
              </div>
              <div class="col-md-12">
                <button type="submit" name="add_product" class="btn btn-danger col-md-6 col-md-offset-3">ENVIAR</button>
              </div>              
          </form>         
          
         </div>
        </div>
      </div>
      <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>
                
                <div style="display: flex;justify-content: space-evenly;">
                  <span ><span class="glyphicon glyphicon-gift"></span> Producto: <span id="nameCost"></span></span>
                  <span ><span class="glyphicon glyphicon-gift"></span> Categoria: <span id="nameCost2"></span></span>  
                </div>                
             </strong>
            </div>
            <div class="panel-body">
             <div id="content" class="col-md-12">              
             </div>
             <div class="col-md-6 col-md-offset-3" style="margin-top: 35px;}">
              <div>
                <label  style="text-align: center; width: 100%;">COSTO UNITARIO</label>
              </div>             
              <div class="input-group">
                 <span class="input-group-addon">                      
                  <i class="glyphicon glyphicon-usd"></i>
                 </span>                     
                 <div id="resultado" readonly class="form-control"></div>                      
              </div>
             </div>
            </div>
          </div>
    </div>

  </div>

      </div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

  <script type="text/javascript">    
    function redireccionar2(obj) {
    var valorSeleccionado = obj.options[obj.selectedIndex].text; 
    $("#nameCost2").html(valorSeleccionado);    
    }
    function redireccionar(obj) {
      /*if ( valorSeleccionado != "" || valorSeleccionado2 != "" ) {                     
      }*/
    var valorSeleccionado = obj.options[obj.selectedIndex].value;        
    var valorSeleccionado2 = obj.options[obj.selectedIndex].text;        
      $.post("getData.php",{ 'valorSeleccionado': valorSeleccionado,'valorSeleccionado2': valorSeleccionado2 }, function(data){
       if (data.length<=10) {                   
         $("#aqui").val(data);           
       }else{          
         $("#content").html(data);           
       }       
    }); 
    }    
    $(document).ready(function () {
        $("#product-title").keyup(function () {
            var value = $(this).val();
            $("#nameCost").html(value);            
        });

        $('#btnAdd').click(function() {
            var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
            var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
        
            // create the new element via clone(), and manipulate it's ID using newNum value
            var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
        
            // manipulate the name/id values of the input inside the new element
            newElem.children(':first').attr('id', 'name' + newNum).attr('name', 'name' + newNum);
        
            // insert the new element after the last "duplicatable" input field
            $('#input' + num).after(newElem);
        
            // enable the "remove" button
            $('#btnDel').attr('disabled',false);
        
            // business rule: you can only add 5 names
            if (newNum == 6)
                $('#btnAdd').attr('disabled','disabled');
        });               
        
        $('#btnDel').click(function() {
            var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
            $('#input' + num).remove();     // remove the last element
        
            // enable the "add" button
            $('#btnAdd').attr('disabled',false);
        
            // if only one element remains, disable the "remove" button
            if (num-1 == 1)
                $('#btnDel').attr('disabled','disabled');
        });
        
        $('#btnDel').attr('disabled','disabled');
    });   

  </script>

<?php include_once('layouts/footer.php'); ?>
