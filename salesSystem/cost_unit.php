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
          <form id="frm_conformidad" >
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
                    <select onchange="redireccionar(this);" class="form-control" name="product-categorie" id="product-categorie">
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
                    <select onchange="redireccionar(this);" class="form-control" name="product-photo" id="product-photo">
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
                  <input type="button" onclick="more()" id="btnAdd" class="btn btn-primary"  value="Más insumos"  title="Agregar" style="font-size: 120%;" /> 
                  <input type="button" onclick="less()" id="btnDel" class="btn btn-primary"  value="Menos insumos" title="Quitar" style="font-size: 120%;" />                     
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
                 <div id="result" readonly class="form-control"></div>                      
              </div>
             </div>
            </div>
          </div>
    </div>

  </div>

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

                $("#result").html(costUnit);                    
                }   
            })
                          
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
