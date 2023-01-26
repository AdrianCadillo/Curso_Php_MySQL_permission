<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PolluxUI Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/libs/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?php echo URL; ?>public/libs/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/libs/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo URL; ?>public/libs/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?php echo URL; ?>public/libs/images/logo-dark.svg" alt="logo">
              </div>
              <h4>Bienveido al sistema</h4>
              <h6 class="font-weight-light">Ingrese sus credenciales</h6>
              <form class="pt-3" action="/login/login"method="POST">

               <div class="form-group">
                  <select name="rol" id="rol" class="form-control">
                   <option disabled selected> --- Seleccione su perfíl --- </option> 
                   <?php if(isset($this->Roles)): ?>
                     <?php foreach($this->Roles as $role): ?>
                      <option value="<?php echo $role->id_role; ?>"><?php echo $role->name_rol; ?></option>
                     <?php endforeach; ?>   
                   <?php endif; ?>
                  </select>
                </div>

                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username"
                  name="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password"
                  name="password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"  >SIGN IN</button>
                </div>
              </form>
 
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="<?php echo URL; ?>public/libs/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php echo URL; ?>public/libs/js/off-canvas.js"></script>
  <script src="<?php echo URL; ?>public/libs/js/hoverable-collapse.js"></script>
  <script src="<?php echo URL; ?>public/libs/js/template.js"></script>
  <script src="<?php echo URL; ?>public/libs/js/settings.js"></script>
  <script src="<?php echo URL; ?>public/libs/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
