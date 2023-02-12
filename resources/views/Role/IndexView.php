<div class="container">
    <div class="card">
        <div class="card-header">
            <span class="float-start py-3"><h6>Listado de roles</h6></span>

            <span class="float-end" onclick="location.href='/role/create'"><button class="button_new"><b>+ Nuevo</b></button></span>
        </div>

        <div class="card-body">
        <?php if ($this->getSession("mensaje")) : ?>
                    <?php if ($this->getValueSession("mensaje") === '1') : ?>
                        <div class="alert alert-success">
                            <strong>Rol modificado correctamente</strong>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->getValueSession("mensaje") === 'existe') : ?>
                        <div class="alert alert-warning">
                            <strong>No se permite duplicación de datos</strong>
                        </div>
                    <?php endif; ?>
                <?php unset($_SESSION['mensaje']);
                endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered responsive table-striped nowrap" id="Tabla_roles" style="width: 100%;">
                 <thead>
                  <tr>
                   
                    <th>NOMBRE ROL</th>
                    <th>PERMISOS</th>
                    <th>GESTIONAR</th>
                  </tr>  
                 </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo URL; ?>public/js/control.js"></script>
<script>
var Id;
$(document).ready(function(){
Listar()
});

var Listar = function(){
    var TablaRoles = $('#Tabla_roles').DataTable({
     language:lenguajeDataTableSpanish(),

     "ajax":{
      url:"/role/showRoles",
      method:"GET",
      dataSrc:'roles'
     },
     "columns":[
     {"data":"name_rol"},
     {"data":"permissions",render:function(dta){
      let Data='';
      if(dta.length>0){
       dta.forEach(element => {
        Data+='<span class="badge badge-info">'+element+'</span>\t';
       });
      }else{
       Data='<span class="badge badge-danger"><b>No posee permisos asignados</b></span>'  
      }
      return Data;
     }
    },
    {"defaultContent":`
    <div class='row'>
    <div class='col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12'><button class='btn btn-warning btn-rounded btn-fw' id='editar'><i class='fas fa-pencil'></i></button></div>
    <div class='col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12'><button class='btn btn-danger btn-rounded btn-fw' id='delete'><i class='fas fa-trash-alt'></i></button></div>
    </div>
    `} 
     ]
    })

    /// eliminar

    ConfirmDelete('#Tabla_roles tbody',TablaRoles)

    // editar

    editar('#Tabla_roles tbody',TablaRoles)
}

/// confirmar eliminar

var ConfirmDelete = function(Tbody,Tabla){
$(Tbody).on('click','#delete',function(){
// obtener la fila seleccionado

let Fila = $(this).parents('tr');

 if(Fila.hasClass('child')){
  Fila = Fila.prev()  
 }

 let Datos = Tabla.row(Fila).data()
 
 let SessionPerfil = '<?php echo $this->getValueSession("perfil");?>';
 if(SessionPerfil !== Datos.name_rol){
 Swal.fire({
        title: 'Desea eliminar al rol '+Datos.name_rol+" ?",
        text: "Al eliminar al rol "+Datos.name_rol+" , se eliminará sus permisos, y a la vez los roles asignados a los usuarios",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar'
      }).then((result) => {
        if (result.isConfirmed) {
           eliminar(Datos.id_role)

           Tabla.ajax.reload(null,false)
        }
 })
}else{
 Swal.fire({
  title:"Mensaje del sistema",
  text:"Error, usted no puede eliminar ese rol, ya que pertenece a su cuenta que esta en session en estos momentos",
  icon:"error"  
 });   
}
});    
}

// metodo para eliminar

var eliminar = function(id){
$.post('/role/delete/'+id,function(response){
    if(response == 1){

Swal.fire({
  title:"Mensaje del sistema",
  text:"Rol eliminado",
  icon:"success"  
 })   
}else{
    Swal.fire({
  title:"Mensaje del sistema",
  text:"Error al eliminar rol",
  icon:"error"  
 });  
}
});
};

var editar= function(Tbody,Tabla){
$(Tbody).on('click','#editar',function(){
// obtener la fila seleccionado

let Fila = $(this).parents('tr');

 if(Fila.hasClass('child')){
  Fila = Fila.prev()  
 }

 let Datos = Tabla.row(Fila).data()
 
 /// redirigir

 location.href='<?php echo URL; ?>role/editar/'+Datos.id_role+'/'+Datos.name_rol
});
}
</script>
 
