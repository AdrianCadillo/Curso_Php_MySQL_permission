
<!---- RESPALDO LA BASE DE DATOS -------->
<div class="container m-1">
    <div class="card border-info">
        <div class="card-header bg-info text-white">
            <h5>Realizar copia seguridad</h5>
        </div>

        <div class="card-body">

            <form action="/configuracion/generar_Copia" method="post">
                <div class="form-group">
                    <label for="name_copia"><b>Nombre del respaldo (*)</b></label>
                    <input type="text" name="name_copia" id="name_copia" class="form-control"
                    autofocus autocomplete="name_copia" required placeholder="Ingrese nombre de respaldo...">
                </div>

                <div class="text-center py-2">
                    <button class="button_new" name="respaldo"><b> Generar respaldo <i class="fas fa-database"></i></b></button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<!---- RESTAURAR LA BASE DE DATOS -------->

<div class="container m-1">
    <div class="card border-warning">
        <div class="card-header bg-warning text-white">
            <h5>Restaurar la base de datos copia seguridad</h5>
        </div>

        <div class="card-body">
      
        <?php if($this->getSession("mensaje")): ?>
        <?php if($this->getValueSession("mensaje") === 'success'): ?>
          <div class="alert alert-success"><b>La Base de datos se a restaurado correctamente <i class="fas fa-check"></i></b></div>
         <?php endif; ?>  
         
         <?php if($this->getValueSession("mensaje") === 'error'): ?>
          <div class="alert alert-danger"><b>Ocurrió un error al intentar restaurar la base de datos <i class="fas fa-close"></i></b></div>
         <?php endif; ?>  

         <?php if($this->getValueSession("mensaje") === 'error_archivo'): ?>
          <div class="alert alert-danger"><b>Error, el archivo seleccionado no es lo correcto  <i class="fas fa-close"></i></b></div>
         <?php endif; ?>  
         
         <?php unset($_SESSION['mensaje']); endif; ?>   

            <form action="/configuracion/restore" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name_copia">Seleccione un archivo <b>.sql(*)</b></label>

                    <input type="file" name="file_sql" id="file_sql" class="form-control">
                </div>

                <div class="text-center py-2">
                    <button class="button_new" name="restaurar"><b> restaurar <i class="fas fa-database"></i></b></button>
                </div>

            </form>
        </div>
    </div>
</div>
