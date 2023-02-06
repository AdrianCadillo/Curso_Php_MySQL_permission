<?php if(isset($this->Role)): ?>
    <div class="container">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <span class="float-start mt-2">
                    <h6>Editar roles</h6>
                </span>
            </div>

            <div class="card-body">
        
                <form action="/role/update/<?=$this->Role[0]->id_role.'/'.$this->Role[0]->name_rol?>" method="post">
                    <div class="form-group">
                        <label for="role"><b>Nombre rol (*)</b></label>
                        <input type="text" name="rolname" id="role" placeholder="Nombre del rol..." autofocus autocomplete="role" required class="form-control"
                        value="<?php echo $this->Role[0]->name_rol; ?>">
                    </div>

                    <div class="row">
                        <b> ----- Seleccione los permisos para este rol ----- </b>
                    </div>

                    <div class="row" id="permisos">
                        <?php if (isset($this->Permissions) and isset($this->Permissions_Asigned) and isset($this->Permissions_No_Asigned)) : ?>
                            <?php foreach ($this->Permissions as $permiso) : ?>
                            <!---------- PERMISOS ASIGNADOS ------------------------------>

                                <?php foreach ($this->Permissions_Asigned as $permiso_asignado) : ?>

                                    <?php if ($permiso->id_permiso == $permiso_asignado->id_permiso) : ?>
                                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                            <i>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="permission[]" id="<?php echo $permiso->id_permiso; ?>"
                                                    value="<?php echo $permiso->id_permiso; ?>" checked>
                                                    <label class="form-check-label" for="<?php echo $permiso->id_permiso; ?>" style="cursor: pointer;"><?php echo $permiso->descripcion; ?></label>
                                                </div>
                                            </i>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                              <!------------ PERMISOS NO ASIGNADOS ---------------------------->

                              <?php foreach ($this->Permissions_No_Asigned as $permiso_no_asignado) : ?>

                                    <?php if ($permiso->id_permiso == $permiso_no_asignado->id_permiso) : ?>
                                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                            <i>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="permission[]" id="<?php echo $permiso->id_permiso; ?>"
                                                    value="<?php echo $permiso->id_permiso; ?>">
                                                    <label class="form-check-label" for="<?php echo $permiso->id_permiso; ?>" style="cursor: pointer;"><?php echo $permiso->descripcion; ?></label>
                                                </div>
                                            </i>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="text-center py-2">
                        <button class="btn_save"><b>Guardar <i class="fas fa-save"></i></b></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php else: ?>
 
    <div class="py-5 alert alert-danger"><b>Error, pagina no autorizado</b></div>
<?php endif; ?>    

<script>
 $('#role').select()   
</script>