
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
      <form method="post" action="product.php">
        <div class="modal-body"> 
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
      <form method="post" id="id_formulario" action=';$action='"delete_product.php">';
 $html3='       <input type="hidden" id="id" name="id" >                               
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          
        </div>
      </form>                        
    </div>
  </div>
</div>';
  $html=$html2.$html3;

 ?>
<?php

if(isset($_POST['id']) && isset($_POST['quantity'])){
  $quantity=$_POST['quantity'];    
  $idAdd=$_POST['id'];    
  $name=$_POST['name'];    
  $data=array($quantity,$idAdd,$name,$html1);
  
}
elseif (isset($_POST['id']) && $process=='true') {
  $id=$_POST['id'];    
  $val='';
  $data=array($id,$val,$html);
}
else{
  $id=$_POST['id'];    
  $val='';
  $data=array($id,$val,$html2);
}

  echo json_encode($data);
  return $data;
?>
  

