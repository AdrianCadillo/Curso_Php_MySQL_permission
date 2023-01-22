<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Crear usuario</h4>
        </div>

        <div class="card-body">
            <form action="/usuario/save" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label for="username"><b>Username (*) </b></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username...." autofocus autocomplete="username" required>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label for="email"><b>Email (*) </b></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa tu email..." autocomplete="email" required>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-12">
                        <div class="form-group">
                            <label for="pasword"><b>Password (*) </b></label>
                            <input type="pasword" name="pasword" id="pasword" class="form-control" placeholder="Ingresa tu Password..." autocomplete="pasword" required>
                        </div>
                    </div>

                </div>

                <div class="row justify-content-center">
                    <img src="<?php echo URL; ?>public/libs/images/anonimo.png" alt="" style="width: 140px;height: 140px;" class="img-fluid rounded" id="img">
                </div>

                <div class="text-center py-2">
                    <button class="btn btn-info btn-rounded btn-fw" id="upload_"><b><i class="fas fa-upload"></i> Subir Foto</b></button>
                    <input type="file" name="foto" class="d-none" id="foto">
                </div>

                <div class="row py-2">
                    <?php
                    foreach ($this->roles_ as $role) :
                    ?>
                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-12">
                            <label for="<?php echo $role->id_role; ?>">
                                <?php echo $role->name_rol; ?>
                            </label>

                            <input type="checkbox" name="rol[]" id="<?php echo $role->id_role; ?>" value="<?php echo $role->id_role; ?>" style="width: 26px;height: 26px;">
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="text-center py-3">
                    <button class="btn btn-success btn-rounded btn-fw">Guardar usuario
                        <i class="fas fa-save"></i>
                    </button>
                </div>

                <div class="text-center py-2">
                    <?php
                    if ($this->getSession("mensaje")) :

                        if ($this->getValueSession("mensaje") === 'existe') :
                    ?>

                            <div class="alert alert-warning">
                                <b>Ya existe este usuario</b>
                            </div>
                        <?php endif; ?>

                        <?php
                        if ($this->getValueSession("mensaje") === '2') :
                        ?>
                            <div class="alert alert-danger">
                                <b>Error, por lo menos seleccione un rol</b>
                            </div>
                        <?php endif; ?>

                        <?php
                        if ($this->getValueSession("mensaje") === '1') :
                        ?>
                            <div class="alert alert-success">
                                <b>Usuario registrado</b>
                            </div>
                        <?php endif; ?>

                    <?php unset($_SESSION['mensaje']);
                    endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo URL; ?>public/js/usuario.js"></script>
<script>
    $(document).ready(function() {
        $('#upload_').click((e) => {
            e.preventDefault();
            $('#foto').click();
        });

        $('#foto').change(function() {
            LeerImagen(this, 'img');
        });
    });
</script>