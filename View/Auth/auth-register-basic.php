
<?php
require_once '../../Models/Users.php';
require_once '../../Controllers/AuthController.php';

if(!isset($_SESSION["username"]))
{
  session_start();
}
$errMsg="";
if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['username']) && isset($_POST['FullName'])) 
{
  if (!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['username'])&& !empty($_POST['FullName'])) 
  {
    $user=new Users;
    $auth=new AuthController;
    $user->setusername($_POST['username']);
    $user->setPass($_POST['pass']);
    $user->email=$_POST['email'];
   
    $user->FullName=$_POST['FullName'];
    if($auth->register($user))
    {
      if(!$auth->login($user))
      {
          if(!isset($_SESSION["position"]))
          {
              // session_start();
          }
          $errMsg=$_SESSION["errMsg"];
      }
      else
      {
          if(!isset($_SESSION["position"]))
          {
              session_start();
          }
          else if($_SESSION["position"]=='admin')
          {
              header("location: ../Admin/Admin.php");
          }
          else if($_SESSION["position"]=="author")
          {
              header("location: ../Author/author.php");
          }
          else
          {
            header("location: ../User/Home.php");
          }

      }
    }
    else
    {
      $errMsg=$_SESSION["errMsg"];
    }

  }
  else
  {
    $errMsg="Please fill all fields";
  }

}

?>

<!DOCTYPE html>

<!-- =========================================================
* CairoNews - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/CairoNews-bootstrap-html-admin-template/
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

    <title>Register-CairoNews</title>

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
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

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
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="../home.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="../assets/img/favicon/pyramid.png" alt=""style width="10%">
                    <span class="app-brand-text demo text-body fw-bolder" style="position: absolute; padding-left: 6rem;">CairoNews</span>
                    
                  </span>
                  
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Adventure starts here </h4>
              <?php 
              
                if($errMsg!="")
                {
                    ?>
                        <div class="alert alert-danger" role="alert"><?php echo $errMsg ?></div>
                    <?php
                }
              
              ?>
            <form id="formAuthentication" class="mb-3" action="auth-register-basic.php" method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">UserName</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your name" autofocus />
              </div>
              <div class="mb-3">
                <label for="FullName" class="form-label">FullName</label>
                <input type="text" class="form-control" id="FullName" name="FullName" placeholder="Enter your FullName" autofocus />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="pass" id="pass" class="form-control" name="pass" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <div class="mb-3">
              </div>
              <button class="btn btn-primary d-grid w-100">Sign up</button>
            </form>

            <p class="text-center">
              <span>Already have an account?</span>
              <a href="auth-login-basic.php">
                <span>Sign in instead</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>

 

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
