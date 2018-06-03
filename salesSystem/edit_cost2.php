<?php
  $page_title = 'Costo Unitario';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page.
  page_require_level(2);

?>

<?php
$product = find_by_id('processed_products',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_distributors = find_all('distributors');
$all_photo = find_all('media');
$all_expenses = find_all('production_expenses');
$all_measures = find_all('measures');
$all_presentations = find_all('presentations');
$all_cost = find_all('cost_product');

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
                 redirect('edit_product.php?id='.$product['id'], false);
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
<form action="save_cost.php" method="post"  class="clearfix">
  <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar datos del producto</span>
         </strong>
        </div>
        <div class="panel-body" style="padding: 15px 0px 15px 0px;">
         <div class="col-md-12">          
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" id="product-title" placeholder="Descripción" value="<?php echo remove_junk($product['name']);?>">
               </div>
              </div>     

              <div class="form-group">
                <div class="row">                   
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>
                      <input type="text" class="form-control" name="product-unit" placeholder="Unidad de medida" value="<?php echo remove_junk($product['unit']);?>">
                   </div> 
                  </div>
                  <div class="col-md-6" >
                    <select class="form-control" name="measure_id" id="measure_id">
                      <option value="">Selecciona la medida</option>
                    <?php  foreach ($all_measures as $measure): ?>
                      <option value="<?php echo (int)$measure['id'] ?>" <?php if($product['measure_id'] === $measure['id']): echo "selected"; endif; ?>>
                        <?php remove_junk($measure['name']); ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>  
                </div>  
              </div>       

              <div class="form-group">
                <div class="row">                   
                  <div class="col-md-6">
                    <select class="form-control" name="product-presentation">
                      <option value="">Selecciona la presentacion</option>
                    <?php  foreach ($all_presentations as $presentation): ?>
                      <option value="<?php echo (int)$presentation['id'] ?>"  <?php if($product['presentation_id'] === $presentation['id']): echo "selected"; endif; ?>>
                        <?php echo remove_junk($presentation['name']); ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6" >
                    <select onchange="redireccionar(this);" class="form-control" name="product-categorie" id="product-categorie">
                      <option value="">Selecciona la categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?>>
                        <?php echo remove_junk($cat['name']); ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>  
                </div>  
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <select onchange="redireccionar(this);" class="form-control" name="product-photo" id="product-photo">
                      <option value="">Selecciona la imagen</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>" <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?>>
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>  
                </div>
              </div>                          

              <div class="panel panel-default">
                <div class="panel-heading">
                  <strong>                
                    <div style="font-size: 12px;display: flex;justify-content: space-evenly;">
                      <span ><span class="glyphicon glyphicon-gift"></span> Producto: <span id="nameCost"></span></span>
                      <span ><span class="glyphicon glyphicon-gift"></span> Categoria: <span id="nameCost2"></span></span>  
                    </div>                
                 </strong>
                </div>
                <div class="panel-body">
                 <div id="content" class="col-md-12">              
                 </div>
                 <div class="col-md-6 col-md-offset-3" style="margin-top: 20px;">
                  <div>
                    <label  style="text-align: center; width: 100%;">COSTO UNITARIO</label>
                  </div>             
                  <div class="input-group">
                     <span class="input-group-addon">                      
                      <i class="glyphicon glyphicon-usd"></i>
                     </span>   
                     <?php  foreach ($all_cost as $cost): ?>
                         <?php if ($product['cost_id'] === $cost['id']): ?>
                           <input type="text" readonly class="form-control" name="result" id="result" value="<?php echo remove_junk($cost['cost_unit']);?>">   
                         <?php endif ?>
                     <?php endforeach; ?> 
                  </div>
                 </div>
                </div>
              </div>
         </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>AGREGAR INSUMOS DEL PRODUCTO</span>
           </strong>
          </div>
          <div class="panel-body">
             <div class="form-group">
               <div class="row clonedInput " id="entry1" style="margin-bottom:4px;opacity: 15;">
                  <div class="col-md-6" >
                    <select onchange="redireccionar(this);" class="select_ttl form-control" name="expense" id="expense">
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
                        <div>
                          <input id="unit" name="unit" type="text" placeholder="Unidad" class="input_fn form-control">  
                        </div>
                        <div>
                          <input id="measure" name="measure" type="text" placeholder="" disabled class="input_ln form-control">  
                        </div>
                      </div>
                   </div>
                  </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                <?php  foreach ($all_cost as $cost): ?>
                    <?php if ($product['cost_id'] === $cost['id']): ?> 
                  <input type="text" class="form-control" name="allBag" id="allBag" placeholder="Ingrese el Producto Total x Bolsa" value="<?php echo remove_junk($cost['quantity']);?>">
                    <?php endif ?>
                <?php endforeach; ?> 

               </div>
              </div>              
              <div style="display: flex;justify-content: space-evenly;margin-top: 4%;">   
                <input type="button" onclick="more()" id="btnAdd" class="btn btn-primary"  value="Más insumos"  title="Agregar" style="font-size: 120%;" /> 
                <input type="button" onclick="less()" id="btnDel" class="btn btn-primary"  value="Menos insumos" title="Quitar" style="font-size: 120%;" />                     
              </div>
            </div>
          </div>
          </div>
          <div class="col-md-12">                
            <button class="btn btn-danger col-md-6 col-md-offset-3" type="button" id="ok">VERIFICAR</button>
            <button type="submit" name="add_product" class="btn btn-success col-md-6 col-md-offset-3" style="margin-top: 8px;">GUARDAR CAMBIOS</button>
          </div>
      </div> 
  </form>   
</div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

  <script type="text/javascript">      
    b=0;
    function less(){
      b=b+1;      
    }
    a=1;
    function more(){
      a=a+1;
    }   
    function redireccionar(obj) {
      var valorSeleccionado = obj.options[obj.selectedIndex].value;              
      var valorSeleccionado2 =  document.getElementById("product-photo").value;
      var valorSeleccionado3 =  document.getElementById("product-categorie").value;

      if ( valorSeleccionado != "") {  
        $.post("getData.php",{ 'valorSeleccionado': valorSeleccionado }, function(data){
          if (obj.id=="expense") {
            $("#measure").val(data);
          }   
          var i=2;                               
          while(i<=(a-b)){
            expense="ID"+i+"_expense";
            measure="#ID"+i+"_measure";
            switch( obj.id ){
              case expense:
                  $(measure).val(data);
              break;
            }
            i=i+1;               
          }        
        }); 
      }

      if ( valorSeleccionado2 != "") {              
            var id = document.getElementById("product-photo");
            var valorSeleccionado2 = id.options[id.selectedIndex].text;            
            $.post("getData.php",{ 'valorSeleccionado': valorSeleccionado2 }, function(data){
             $("#content").html(data);        
          }); 
      }

      if ( valorSeleccionado3 != "") {              
            var id = document.getElementById("product-categorie");
            var valorSeleccionado3 = id.options[id.selectedIndex].text;            
            $("#nameCost2").html(valorSeleccionado3); 
      }        
    }    

    $("#ok").on('click', function() { 
          var formData= new FormData();       
          var expense =$('#expense').val();
          formData.append("expense", expense);
          var i=1;          
          var array= new Array;
          enumerate=0; 

          while(i<(a-b)){          
            i=i+1;                                           
            array.push("#ID"+i+"_expense");             
            var dataExpense =$(array[enumerate]).val();
            formData.append(array[enumerate], dataExpense);
            enumerate=enumerate+1;
          }         
          
          $.ajax({
              method: "POST",
              url: "getCost.php",
              data: formData,
              contentType: false,
               processData: false,
               beforeSend: function () {                 
                 /*for (var pair of formData.entries()) {
                     console.log(pair[0]+ ', ' + pair[1]); 
                 }*/                 
               },
              success: function(data){                
                response = JSON.parse(data);                
                size=Object.keys(response).length;               
                unitFirst =$('#unit').val();
                allBag =$('#allBag').val();
                valueFirst=response[0]*parseFloat(unitFirst); 
                i=1;
                content=0;
                enumerate=2;                
                while(i<size){

                  value='#ID'+enumerate+'_unit';
                  valueResult =$(value).val();                  
                  valueAll=response[i]*parseFloat(valueResult);
                  content=parseFloat(content)+parseFloat(valueAll);                                       
                  i=i+1;
                  enumerate=enumerate+1;
                }

                allInput=parseFloat(content)+parseFloat(valueFirst);                
                allLabor=parseFloat(2.5)*parseFloat(unitFirst);                
                gas=parseFloat(0.36)*parseFloat(unitFirst);
                allCost=parseFloat(allInput)+parseFloat(allLabor)+parseFloat(gas);                
                costUnit=parseFloat(allCost)/parseFloat(allBag);
                costUnit=costUnit.toFixed(2);

                $("#result").val(costUnit);                    
                }   
            })
                          
          });    


    $("#frm_conformidad").submit(function(event){

                event.preventDefault(); // cancel submit
                        var formData= new FormData($("#frm_conformidad")[0]);
                        //var incidente_id=$("#incidente_id").val();
                        //console.log(incidente_id);
                        $.ajax({
                             type: "POST",
                             url: 'save_cost.php',
                             data: formData,
                             contentType: false,
                             processData: false,
                             beforeSend: function (response) {
                                /*$("frm_conformidad").submit();
                                $("#modal-acta3").modal("toggle");*/
                             },
                              success: function(response)
                              {                              
                                  
                                  //CargarDetalle('mesa_de_ayuda/detalle_incidente',incidente_id);
                              }
                          });
                });


    $(document).ready(function () {
        $("#product-title").keyup(function () {
            var value = $(this).val();
            $("#nameCost").html(value);            
        });

        $('#btnAdd').click(function() {
            var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
            var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
            // create the new element via clone(), and manipulate it's ID using newNum value

            var newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); 

            newElem.find('.select_ttl').attr('id', 'ID' + newNum + '_expense').attr('name', 'ID' + newNum + '_expense').val('');
            newElem.find('.input_fn').attr('id', 'ID' + newNum + '_unit').attr('name', 'ID' + newNum + '_unit').val('');
            newElem.find('.input_ln').attr('id', 'ID' + newNum + '_measure').attr('name', 'ID' + newNum + '_measure').val('');
        
            // insert the new element after the last "duplicatable" input field
            $('#entry' + num).after(newElem);
        
            // enable the "remove" button
            $('#btnDel').attr('disabled',false);
        
            // business rule: you can only add 5 names
            if (newNum == 15)
                $('#btnAdd').attr('disabled','disabled');
        });               
        
        $('#btnDel').click(function() {
            var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
            $('#entry' + num).remove();     // remove the last element
        
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
