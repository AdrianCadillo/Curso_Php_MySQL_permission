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
                        <a href="" class="btn btn-warning btn-rounded btn-fw btn-sm"><i class="fas fa-pencil"></i></a>    
                        </div>
                        
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12 m-1">
                        <form action="" method="post">
                          <button class="btn btn-danger btn-rounded btn-fw btn-sm"><i class="fas fa-trash-alt"></i></button>  
                        </form>
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

<script src="<?php echo URL; ?>public/js/control.js"></script>

<script>
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
});
</script>