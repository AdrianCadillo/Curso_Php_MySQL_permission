<div class="container">
    <div class="card">
        <div class="card-header">
        <span class="float-start">  <h6>Crear roles</h6> </span>
        
        <span class="float-end" id="modal_view_permisos"><button class="button_new"><b> + permiso</b></button></span>
        </div>

        <div class="card-body">
        <?php if($this->getSession("mensaje")): ?>
         <?php if($this->getValueSession("mensaje") === '1'): ?>
         <div class="alert alert-success">
           <strong>Rol creado correctamente</strong>
         </div>
         <?php endif; ?>   

         <?php if($this->getValueSession("mensaje") === 'existe'): ?>
         <div class="alert alert-danger">
           <strong>Error al crear rol, porque hay duplicación de datos</strong>
         </div>
         <?php endif; ?>   
        <?php unset($_SESSION['mensaje']);endif; ?>    
        <form action="/role/store" method="post">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="rolname"><b>Nombre Rol (*)</b></label>
                    <input type="text" name="rolname" id="rolname" placeholder="Nombre rol.."
                    class="form-control" autofocus autocomplete="rolname" required>
                </div>
            </div>

            <b>Seleccione los permisos para este rol</b>
        </div>

        <div class="row py-3" id="permisos">

        </div>

        <div class="text-center py-3">
            <button class="btn_save"><i class="fas fa-save"></i><b>Guardar</b></button>
        </div>
    </form>
        </div>
    </div>
</div>

<!----- MODAL PARA CREAR NUEVOS PERMISOS -------->

<div class="modal fade" id="modal_permisos_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
       <span class="float-start"><h6>Crear nuevos permisos</h6></span>

       <span class="float-end"><button class="btn btn-danger btn-rounded btn-fw" id="salir_modulo"
       onclick="$('#modal_permisos_create').modal('hide')">
        <i class="fas fa-window-close"></i>
       </button></span>
      </div>
    <div class="modal-body">
      <div class="form-group">
       <label for="name_modulo"><b>Nombre Permiso (*)</b></label>
       <input type="text" id="name_permiso" class="form-control" placeholder="Nombre Permiso..."> 
      </div>

      <div class="form-group">
       <label for="descripcion"><b>Descripción (*)</b></label>
       <input type="text" id="descripcion" class="form-control" placeholder="Descripción..."> 
      </div>

      <div class="form-group">
       <label for="descripcion"><b>Seleccione su módulo (*)</b></label>
       <select name="modulo" id="modulo" class="form-select">
        <option selected disabled> ----- Seleccione un módulo ----- </option> 
        <?php if(isset($this->Modulos)): ?>
         <?php  foreach($this->Modulos as $module): ?>
          <option value="<?php echo $module->id_modulo;?>"><?php echo $module->name_modulo; ?></option>
         <?php endforeach; ?>   
        <?php endif; ?>    
       </select>
      </div>

      <div class="text-center py-1">
        <button  class="btn_save" id="update_modulo"><b><i class="fas fa-save"></i> Guardar</b></button>
      </div>
    </div>
    </div>
  </div>
</div>

<script>
var Base_Url_ ='<?php echo URL;?>';

var NombrePermiso = $('#name_permiso');

var Descripcion = $('#descripcion');

var Modulo = $('#modulo')

mostrar_Permisos()

$('#modal_view_permisos').click(()=>{
 $('#modal_permisos_create').modal('show')   
});

$('#update_modulo').click(function(){
    save_Permiso(NombrePermiso.val(),Descripcion.val(),Modulo.val())
});
function mostrar_Permisos()
{
let Contenido = "";    
$.ajax({
url:Base_Url_+"role/show_permisos",
method:"POST",
success:function(response){
response = JSON.parse(response);

response = response.permisos;

response.forEach(element => {

Contenido+=`
<div class='col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12'>
   <i>
   <label for=`+element.id_permiso+` style='cursor:pointer'>`+element.descripcion+` 
   <input type='checkbox' name='permisos[]' id=`+element.id_permiso+` value=`+element.id_permiso+`
   style='width:20px;height:17px'>
   </label>
   </i>
</div>
`;   
});

$('#permisos').html(Contenido)
}
});
}

/// registrar permisos

function save_Permiso(Name_Permiso,Descripcion_,Modulo_)
{
$.ajax({
url:Base_Url_+"permission/save",
method:"POST",
data:{accion:'save',name_permiso:Name_Permiso,descripcion:Descripcion_,modulo:Modulo_},
success:function(response){
 if(response == 1){
  Swal.fire({
  "title":"Mensaje del sistema",
  "text":"Permiso creado correctamente",
  "icon":"success"  
  }).then(function(){
    mostrar_Permisos()
  });  
 }else{
  if(response == 'existe'){
 Swal.fire({
  "title":"Mensaje del sistema",
  "text":"No se permite duplicidad de datos",
  "icon":"warning"  
  })
  }else{
    Swal.fire({
  "title":"Mensaje del sistema",
  "text":"Error al crear permiso",
  "icon":"error"  
  })
  }
 }
}
});  
}
</script>