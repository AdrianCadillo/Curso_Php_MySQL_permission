
<?php if(isset($this->Usuarios)): ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Editar Usuario</h4>
        </div>

        <div class="card-body">
            <form action="/usuario/modify/<?php echo $this->Usuarios[0]->id_usuario; ?>" method="post">
            <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-7 col-12">
                        <div class="form-group">
                            <label for="username"><b>Username (*) </b></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username...." autofocus autocomplete="username" required
                            value="<?php echo $this->Usuarios[0]->username; ?>">
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-5 col-md-5 col-12">
                        <div class="form-group">
                            <label for="email"><b>Email (*) </b></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa tu email..." autocomplete="email" required
                            value="<?php  echo $this->Usuarios[0]->email;?>">
                        </div>
                    </div>
                </div>
            
                <div class="row">
                 <u>Seleccione sus roles</u>
                <?php if(isset($this->roles_ )): ?>
                   <?php foreach($this->roles_ as $role): ?>
                     <?php  foreach($this->Roles_Asignados as $roleasign): ?>
                       <?php if($role->name_rol===$roleasign->name_rol): ?>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 py-3">
                        <label for="<?php echo $role->id_role; ?>">
                        <i>
                        <?php echo $role->name_rol; ?>
                        <input type="checkbox" name="rol[]" id="<?php echo $role->id_role; ?>" style="width: 22px;height: 22px;" 
                        value="<?php echo $role->id_role; ?>" checked>
                        </i>
                        </label>
                     </div>
                       <?php endif; ?> 
                     <?php endforeach; ?> 
                     
                     <?php foreach($this->Roles_No_Asignados as $rolenoasign): ?>
                       <?php if($role->name_rol===$rolenoasign->name_rol): ?>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 py-3">
                        <label for="<?php echo $role->id_role; ?>">
                        <i>
                        <?php echo $role->name_rol; ?>
                        <input type="checkbox" name="rol[]" id="<?php echo $role->id_role; ?>" style="width: 22px;height: 22px;" 
                        value="<?php echo $role->id_role; ?>" >
                        </i>
                        </label>
                     </div>
                       <?php endif; ?> 
                     <?php endforeach; ?> 

                   <?php endforeach; ?> 
                <?php endif; ?>    
                
                </div>

                <div class="text-center py-4">
                    <button class="btn btn-success btn-rounded btn-fw"><b>
                    <i class="fas fa-save"></i> Guardar cambios</b></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php else: ?>
<div class="alert alert-danger"><b>Hay errores al editar usuario</b></div>
<?php endif; ?>