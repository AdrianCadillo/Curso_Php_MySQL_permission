<div class="container">
    <div class="card">
        <div class="card-header">
         <span class="float-start mt-2"><h6>Importar datos de módulos</h6></span>
         
         <span class="float-end">
          <form action="/modulo/export_txt" method="post">
           <button name="reporte_txt" class="button_new"><i class="fas fa-file-excel"></i> exportar a txt</button> 
          </form>
         </span>
        </div>

    <div class="card-body">
     <form action="/modulo/import_data" method="post" enctype="multipart/form-data">
      <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-9 col-md-10 col-sm-11 col-12">
        <label for="excel_module"><b>Seleccione un  archivo excel</b></label>
        <input type="file" name="excel_module" id="excel_module">    
        </div>

        <div class="text-center py-4">
            <button class="btn_save" name="import"><i class="fas fa-upload"></i> <b>Importar datos</b></button>
        </div>
      </div>  
     </form>

     <div class="row">
        <div class="col-12">
         <div class="table-responsive-sm">
         <table class="table responsive table-striped nowrap" id="table_modulos"
            style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NOMBRE MODULO</th>
                        <th>KEY MODULO</th>
                        <th>GESTIONAR</th>
                    </tr>
                </thead>
                <tbody>
                <?php $item = 0; if(isset($this->modulos)): ?>
                 <?php foreach($this->modulos as $module): $item++; ?>
                  <tr>
                    <td><?php echo $item; ?></td>
                    <td><?php echo $module->name_modulo;  ?></td>
                    <td>
                    <?php if(!empty($module->key_modulo)): ?>
                     <span class="badge badge-info"><?=$module->key_modulo?></span>  
                    <?php else: ?>
                    <span class="badge badge-danger">no especifica su key</span>  
                    <?php endif; ?> 
                    </td>
                    <td>
                     <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12 m-1">
                        <button class="btn btn-warning btn-rounded btn-fw btn-sm" onclick="$('#modal_modulo_editar').modal('show'); editar(`<?php echo $module->id_modulo?>`,`<?php echo $module->name_modulo?>`,`<?php echo $module->key_modulo?>`);"><i class="fas fa-pencil"></i></button>    
                        </div>
                        
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12 m-1">
                          <button class="btn btn-danger btn-rounded btn-fw btn-sm" onclick="ConfirmDelete(`<?php echo $module->id_modulo?>`,`<?php echo $module->name_modulo?>`)"><i class="fas fa-trash-alt"></i></button>  
                        </div>
                     </div>    
                    </td>
                  </tr>
                 <?php endforeach; ?>   
                <?php endif; ?>    
                </tbody>
            </table>
         </div>
        </div>
     </div>
     
     <?php if($this->getSession("mensaje")): ?>
        
    <?php if($this->getValueSession("mensaje") === '1' or $this->getValueSession("mensaje") === 'existe'): ?>
    <div class="alert alert-success">
       <strong>Datos del excel importados correctamente</strong>
    </div>
    <?php endif; ?>

    <?php if($this->getValueSession("mensaje") === 'vacio'): ?>
    <div class="alert alert-danger">
       <strong>Seleccione un archivo excel</strong>
    </div>
    <?php endif; ?>
     <?php unset($_SESSION['mensaje']); endif; ?>   
    </div>
    </div>
</div>
<!-------- MODAL PARA EDITAR MODULOS ----------->

<div class="modal fade" id="modal_modulo_editar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
       <span class="float-start"><h6>Editar módulos</h6></span>

       <span class="float-end"><button class="btn btn-danger btn-rounded btn-fw" id="salir_modulo">
        <i class="fas fa-window-close"></i>
       </button></span>
      </div>
    <div class="modal-body">
      <div class="form-group">
       <label for="name_modulo"><b>Nombre Módulo (*)</b></label>
       <input type="text" id="name_modulo" class="form-control" placeholder="Nombre módulo"> 
      </div>

      <div class="form-group">
       <label for="key_modulo"><b>Key Módulo (*)</b></label>
       <input type="text" id="key_modulo" class="form-control" placeholder="Key módulo"> 
      </div>
    
      <div class="text-center py-1">
        <button  class="btn_save" id="update_modulo"><b><i class="fas fa-save"></i> Guardar</b></button>
      </div>
    </div>
    </div>
  </div>
</div>
<script src="<?php echo URL; ?>public/js/control.js"></script>

<script>
var Base_Url_ ='<?php echo URL;?>';  
var NombreModulo = $('#name_modulo');

var KeyModulo = $('#key_modulo');

var IdModulo;
$(document).ready(function(){

var TableModulo = $('#table_modulos').DataTable({
language:lenguajeDataTableSpanish()    
});   
 $('#excel_module').change(function(){
 
    var filePath = $(this).val();/// obtenemos la direccion del archivo
    var Extensiones = /(.csv)$/; /// especificamos las extensiones que solo se aceptará
    if(!Extensiones.exec(filePath)){/// verificamos que la extension sea la correcta al seleccionar
    Swal.fire({
    title:"¡AVISO DEL SISTEMA!",
    text:"Error , el archivo es incorrecto,solo se aceptan archivos excel",
    icon:"error"    
    });
    filePath="";$(this).val("");
    return false;
    } 
       
 });

$('#salir_modulo').click(()=>{
  $('#modal_modulo_editar').modal('hide')
});

$('#update_modulo').click(function(){
if(NombreModulo.val().trim().length == 0){
  NombreModulo.focus()
}else{
if(KeyModulo.val().trim().length === 0){
  KeyModulo.focus()
}else{
  update(IdModulo);
}
}
});

});


/// editar
function editar(id,name_modulo,KeyModulo_)
{
 IdModulo = id; NombreModulo.val(name_modulo);

 KeyModulo.val(KeyModulo_)
}

// metodo para modificar los módulos

function update(id){
$.ajax({
url:Base_Url_+"modulo/update/"+id,
method:"POST",
data:{accion:'update',nm:NombreModulo.val(),km:KeyModulo.val()},
success:function(response)
{
 if(response == 1){
  Swal.fire({
  "title":"Mensaje del sistema",
  "text":"Modulo modificado",
  "icon":"success"  
  }).then(function(){
  location.href= '/modulo/import';  
  });
 }else{
  Swal.fire({
  "title":"Mensaje del sistema",
  "text":"Error al modificar Modulo",
  "icon":"error"  
  });
 }
}
});  
}
// confirmar antes de eliminar

function ConfirmDelete(Id,NameModulo_)
{
  
  Swal.fire({
        title: 'Desea eliminar al módulo '+NameModulo_+" ?",
        text: "Al eliminar este módulo, no se podrá recuperar la información",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar'
      }).then((result) => {
        if (result.isConfirmed) {
          Eliminar(Id)
        }
  })
}

/// eliminar módulos

function Eliminar(Id)
{
$.ajax({
url:Base_Url_+"modulo/delete/"+Id,
method:"POST",
data:{accion:'delete'},
success:function(response)
{
 if(response == 1){
  Swal.fire({
  "title":"Mensaje del sistema",
  "text":"Modulo eliminado",
  "icon":"success"  
  }).then(function(){
  location.href= '/modulo/import';  
  });
 }else{
  if(response == 2 ){
    Swal.fire({
  "title":"Mensaje del sistema",
  "text":"Error al eliminar Modulo",
  "icon":"error"  
  });
  }else{
  Swal.fire({
  "title":"Mensaje del sistema",
  "text":"Error al eliminar Modulo",
  "icon":"error"  
  });
  }
 }
}
}); 
}

</script>