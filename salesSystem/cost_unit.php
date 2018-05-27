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
          <form id="frm_conformidad class="clearfix">
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
               <div class="row clonedInput " id="entry1" style="margin-bottom:4px;">
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
                        <input id="unit" name="unit" type="text" placeholder="Unidad" class="input_fn form-control">
                        <input id="measure" name="measure" type="text" placeholder="" disabled class="input_ln form-control">
                      </div>                      
                      
                   </div>
                  </div>
              </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">
                     <i class="glyphicon glyphicon-th-large"></i>
                    </span>
                    <input type="text" class="form-control" name="allBag" id="allBag" placeholder="Ingrese el Producto Total x Bolsa">
                 </div>
                </div>
                
                <div style="display: flex;justify-content: space-evenly;margin-top: 4%;">   
                  <input type="button" id="btnAdd" class="btn btn-primary"  value="Más insumos" title="Agregar" style="font-size: 120%;" /> <input type="button" id="btnDel" class="btn btn-primary"  value="Menos insumos" title="Quitar" style="font-size: 120%;" />                     
                </div>

               </div>
              </div>
              <div class="col-md-12">                
                <button class="btn btn-danger col-md-6 col-md-offset-3" type="button" id="ok">ENVIAR</button>
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

    $("#ok").on('click', function() {
          var formData= new FormData($("#frm_conformidad")[0]);
          numero_compra='numcompra';
          formData.append("numcompra", numero_compra);
          
          $.ajax({
              method: "POST",
              url: "verificar.php",
              data: formData,
              contentType: false,
               processData: false,
               beforeSend: function () {
                 console.log(formData);
               },
              success: function(resp){
                //alert(resp);
                    $('#resultado').html(resp);
                }   
            })
              formData.append('part_description', 'The best part ever!'); //esto no me lo reconoce en el archivo php que mando
                          var datos='holas';
            
          });

    function enviar(){              
                //var allBag = $("#allBag").val();
                var formData= new FormData($("#frm_conformidad")[0]);
                $.post("verificar.php", { 'formData': formData}, function(data){
                $("#resultado").html(data);
                });     
              }

    function redireccionar2(obj) {
    var valorSeleccionado = obj.options[obj.selectedIndex].text; 
    $("#nameCost2").html(valorSeleccionado);    
    }
    function redireccionar(obj) {
      var valorSeleccionado = obj.options[obj.selectedIndex].value;        
      var valorSeleccionado2 = obj.options[obj.selectedIndex].text; 

      if ( valorSeleccionado != "") {  
        $.post("getData.php",{ 'valorSeleccionado': valorSeleccionado }, function(data){
        switch( obj.id ){
           case "expense":
                            $("#measure").val(data);
                            break;
           case "ID2_expense":
                            $("#ID2_measure").val(data); 
                            break;
           case "ID3_expense":
                            $("#ID3_measure").val(data);   
                            break;
           case "ID4_expense":
                             $("#ID4_measure").val(data);
                             break;
           case "ID5_expense":
                             $("#ID5_measure").val(data); 
                             break;
           case "ID6_expense":
                             $("#ID6_measure").val(data);   
                             break;
           case "ID7_expense":
                              $("#ID7_measure").val(data);
                              break;
           case "ID8_expense":
                           $("#ID8_measure").val(data); 
                            break;
           case "ID9_expense":
                            $("#ID9_measure").val(data);   
                            break; 
           case "ID10_expense":
                             $("#ID10_measure").val(data);   
                             break; 

            }
        }); 
      }

      if ( valorSeleccionado2 != "") {  

            $.post("getData.php",{ 'valorSeleccionado': valorSeleccionado2 }, function(data){
             $("#content").html(data);        
          }); 
      }        
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

            var newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); 

            newElem.find('.select_ttl').attr('id', 'ID' + newNum + '_expense').attr('name', 'ID' + newNum + '_expense').val('');
            newElem.find('.input_fn').attr('id', 'ID' + newNum + '_unit').attr('name', 'ID' + newNum + '_unit').val('');
            newElem.find('.input_ln').attr('id', 'ID' + newNum + '_measure').attr('name', 'ID' + newNum + '_measure').val('');
        
            // insert the new element after the last "duplicatable" input field
            $('#entry' + num).after(newElem);
        
            // enable the "remove" button
            $('#btnDel').attr('disabled',false);
        
            // business rule: you can only add 5 names
            if (newNum == 10)
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
