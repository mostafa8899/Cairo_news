<?php 
require_once '../../Models/Users.php';
require_once '../../Controllers/AuthController.php';
$errMsg="";

if (isset($_GET["logout"])) {
  session_start();
  session_destroy();
}

if (isset($_POST['username']) && isset($_POST['pass'])) {
  if (!empty($_POST['username']) && !empty($_POST['pass'])) {

     
      $user = new Users;
      $auth = new AuthController();

      $user->setusername($_POST['username']);
      $user->setPass($_POST['pass']);

      if (!$auth->login($user)) {
          if (!isset($_SESSION["position"])) {
              // session_start();
          }
          $errMsg = $_SESSION["errMsg"];
      } else {
          if (!isset($_SESSION["position"])) {
              session_start();
          } else if ($_SESSION["position"] == 'admin') {
              header("location: ../Admin/Admin.php");
          } else if ($_SESSION["position"] == "author") {
              header("location: ../Author/author.php");
          } else {
              header("location: ../User/Home.php");
          }
      }
  } else {
      $errMsg = "Please fill all fields";
  }
}


?>

<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login-CairoNews</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/pyramid.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href=../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body style="background-image: url(../assets/img/backgrounds/back.jpeg);">
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="../User/Home.php" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="../assets/img/favicon/pyramid.png" alt=""style width="10%">
                    <span class="app-brand-text demo text-body fw-bolder" style="position: absolute; padding-left: 6rem; font-size :1.5rem;">CairoNews</span>
                    
                  </span>
                  
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to CairoNews</h4>

              <?php 
              
                if($errMsg!="")
                {
                    ?>
                        <div class="alert alert-danger" role="alert"><?php echo $errMsg ?></div>
                    <?php
                }
              
              ?>
              
              
              
              <form id="formAuthentication" class="mb-3" action="auth-login-basic.php" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">userName</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Enter your Username"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-pass-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="pass">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="pass"
                      class="form-control"
                      name="pass"
                      placeholder="enter Your Password"
                      aria-describedby="password"
                    />
                    
                  </div>
                </div>
                <div class="mb-3">
                </div>
                <div class="mb-3">
                  <button class="btn rounded-pill btn-dark d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>

              <p class="text-center">
                <span>New on our platform?</span>
                <a href="auth-register-basic.php">
                  <span>Create an account</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
