<div class="container">
   <div class="card">
    <div class="card-header">
     <span class="float-start">
     <button class="btn btn-info btn-rounded btn-fw" onclick="location.href='/usuario/create'"><b> + Nuevo</b></button>   
     </span>

     <span class="float-end">Listado de usuarios</span>
    </div>
    <div class="card-body">

    <?php if($this->getSession("mensajes")): ?>

      <?php if($this->getValueSession("mensajes") === '1' || $this->getValueSession("mensajes") === 'existe'): ?>
       <div class="alert alert-success"><b>Usuario registrado correctamente</b></div>
      <?php endif; ?>  


      <?php if($this->getValueSession("mensajes") === '0'): ?>
       <div class="alert alert-danger"><b>Error al crear usuario</b></div>
      <?php endif; ?>

      
    <?php unset($_SESSION['mensajes']); endif; ?>    

   <!--- MENSAJES PARA ACTUALIZAR DATOS ------>

   <?php if($this->getSession("mensaje_update")): ?>

   <?php if($this->getValueSession("mensaje_update") === '1' || $this->getValueSession("mensaje_update") === 'existe'): ?>
    <div class="alert alert-success"><b>Usuario modificado correctamente</b></div>
   <?php endif; ?>  


   <?php if($this->getValueSession("mensaje_update") === '0'): ?>
    <div class="alert alert-danger"><b>Error al modificar usuario</b></div>
   <?php endif; ?>


   <?php unset($_SESSION['mensaje_update']); endif; ?>  
    <div class="table-responsive-sm">
            <table class="table responsive table-striped nowrap" id="table_roles"
            style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>USUARIO</th>
                        <th>EMAIL</th>
                        <th>ROLES</th>
                        <th>GESTIONAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($this->Usuarios)) :
                        $item = 0;
                        foreach ($this->Usuarios as $user) :
                         $item += 1;
                          ?>
                            <tr>
                                <td scope="row"><?php echo $item; ?></td>
                                <td><?php echo $user->username ?></td>
                                <td><?php echo $user->email ?></td>
                                <td>
                                    <?php
                                    if (count($this->getRolesUsuario($user->id_usuario)) > 0) :

                                        foreach ($this->getRolesUsuario($user->id_usuario) as $role) :
                                     ?>
                                            <span class="badge badge-success"><?php echo $role->name_rol; ?></span>
                                        <?php endforeach; ?>
                                     <?php else: ?>
                                        <span class="badge badge-danger"><b>No posee roles asignados</b></span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                 <div class="row">
                                   <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-12 m-2">
                                    <a href="/usuario/editar/<?php echo $user->id_usuario; ?>" class="btn btn-warning btn-rounded btn-fw btn-sm">
                                     <i class="fas fa-pencil"></i>   
                                    </a>
                                   </div>
                                   
                                   <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-12 m-2">
                                    <button class="btn btn-danger btn-rounded btn-fw btn-sm"
                                     onclick="ConfirmDelete(`<?php echo $user->id_usuario;?>`,`<?php echo $user->username;?>`)">
                                    <i class="fas fa-trash-alt"></i></button>
                                   </div>
                                 </div>   
                                </td>
                            </tr>

                    <?php endforeach;
                    endif; ?>

                </tbody>

            </table>
        </div>
    </div>
   </div>
</div>

<script src="<?php echo URL; ?>public/js/control.js"></script>

<script src="<?php echo URL; ?>public/js/usuario.js"></script>
<script>
$(document).ready(function() {
    $('#table_roles').DataTable({
    language:lenguajeDataTableSpanish()    
    });
});    
</script>