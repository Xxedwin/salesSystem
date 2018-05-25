
<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php 
$html =' 
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLabel">Nombre:<span id="name"></span>  &nbsp;&nbsp; Existencia: <span id="viewQuantity"></span> </h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -48px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action=';      
      switch ($_POST['number']) {
        case 3:
          $html.='"production_expenses.php">';          
          break;
        case 2:
          $html.='"processed_products.php">';
          break;        
        default:
          $html.='"product.php">';
          break;
      } 
      
$html.='  <div class="modal-body"> 
            <div class="form-group">
              <div style="text-align: center;">
                <label for="recipient-name" class="col-form-label">Ingrese la cantidad para añadir al inventario:</label>  
              </div>                            
              <input type="text" class="form-control" name="append_quantity">
              <input type="hidden" class="form-control" name="quantity" id="quantity">
              <input type="hidden" class="form-control" name="idAdd" id="idAdd">
                                              
            </div>   
        </div>
        <div class="modal-footer">
          <button type="submit"  name="append_product" class="btn btn-primary">Guardar cambios</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          
        </div>
      </form>
    </div>
  </div>
</div>';

$html2='

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLabel">¿Estás seguro que deseas eliminar?</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -48px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form method="post" action=';
      switch ($_POST['number']) {
        case 3:
          $html2.='"delete_productExpense.php">';          
          break;
        case 2:
          $html2.='"delete_processProduct.php">';
          break;        
        default:
          $html2.='"delete_product.php">';
          break;
      }           
 $html2.='       <input type="hidden" id="id" name="id" >                               
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          
        </div>
      </form>                        
    </div>
  </div>
</div>';  

 ?>
<?php

if(isset($_POST['id']) && isset($_POST['name'])){
  $quantity=$_POST['quantity'];    
  $idAdd=$_POST['id'];    
  $name=$_POST['name'];    
  $data=array($quantity,$idAdd,$name,$html);
  
}
else{
  $id=$_POST['id'];    
  $val='';
  $data=array($id,$val,$html2);
}

  echo json_encode($data);
  return $data;
?>
  

