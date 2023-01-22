<div class="container">
    <div class="table-responsive">
            <table class="table responsive table-striped nowrap" id="table_roles"
            style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>USUARIO</th>
                        <th>EMAIL</th>
                        <th>ROLES</th>
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
                            </tr>

                    <?php endforeach;
                    endif; ?>

                </tbody>

            </table>
        </div>
</div>
<script>
$(document).ready(function() {
    $('#table_roles').DataTable({});
});    
</script>