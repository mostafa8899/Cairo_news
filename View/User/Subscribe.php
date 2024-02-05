
<?php
session_start();
if (!isset($_SESSION["username"])) {

  header("location:../Auth/auth-login-basic.php ");
} else {
  if ($_SESSION["position"] != "user") {
    header("location:../Auth/auth-login-basic.php ");
  }
}
require_once '../../Models/feedback.php';
require_once '../../Models/Users.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/subscriptionController.php';
require_once '../../Controllers/subscriptionController.php';
$Sub=new subscriptionController;
if(isset($_SESSION["username"])){     
  $username=$_SESSION['username'];
}

if(!isset($_SESSION["username"]))
{
  session_start();
}
$add="";
$errMsg="";
if (isset($_POST['package'])&&isset($_POST['CrdCard']) ) 
{
  if (!empty($_POST['package'])&&!empty($_POST['CrdCard'])) 
  {
    $Subscription=new Subscription;
    $Sub=new subscriptionController;

    
    $Subscription->setUserName($_SESSION['username']);
    // $feedback->adminName=$_POST['username'];
    $Subscription->package=$_POST['package'];
    $Subscription->setCrdCard($_POST['CrdCard']);
    if($Sub->setsubscripe($Subscription))
    {
      $add="Added Successfully";
      // header("location:../User/Subscribe.php ");
      
    }
    else
    {
      $errMsg="Already subscriped";
    }

  }
  else
  {
    $errMsg="Please fill all fields";
  }

}



?>


<!DOCTYPE html>


<html
  lang="en"
  class="light-style layout-menu-fixed"
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

    <title>CairoNews</title>

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
    <link rel="stylesheet" href="../assets/vendor/css/Sub.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/vendor/js/sub.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
         <!-- Menu -->

         <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="Home.php" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="../assets/img/favicon/pyramid.png" alt="" style="width: 10%;">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2" style="z-index: 2; position:absolute; padding-left: 4rem;">CairoNews</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Home -->
            <li class="menu-item ">
              <a href="Home.php" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Home</div>
              </a>
            </li>

            <!-- Categories -->
            <li class="menu-item ">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Categories</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item active">
                  <a href="art.php" class="menu-link">
                    <div data-i18n="Without menu">Art</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="sports.php" class="menu-link">
                    <div data-i18n="Without navbar">Sport</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="science.php" class="menu-link">
                    <div data-i18n="Container">science</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="food.php" class="menu-link">
                    <div data-i18n="Fluid">Food</div>
                  </a>
                </li>
                
              </ul>
            </li>

            
            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">User App</span></li>
            <!-- Cards -->
            <li class="menu-item ">
              <a href="https://www.nytimes.com/crosswords" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Games</div>
              </a>
            </li>
            
           <!-- Tables -->
          <?php if(isset($_SESSION["username"])){ if($Sub->getsupscripe($_SESSION["username"])) {?>
            <!-- Tables -->
             <li class="menu-item">
              <a href="Notification.php" class="menu-link">
              <i class='bx bx-notification bx-tada' ></i>
                <div data-i18n="Tables">Notification</div>
              </a>
            </li>
            <?php
            }
          }
            ?>
            <!-- Misc -->
            <?php
            if(isset($_SESSION["username"])){
                 ?> 
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item">
              <a
                href="Feedback.php"
                
                class="menu-link"
              >
                <i class='bx bx-message-detail'></i>
                <div data-i18n="Support">Feedback</div>
              </a>
            </li>
             
            
            <li class="menu-item active">
              <a
                href="Subscribe.php"
                
                class="menu-link"
              >
               <i class='bx bx-bell-plus bx-burst' ></i>
                <div data-i18n="Documentation">Subscribe</div>
              </a>
            </li>
           
          </ul>
          <?php
            }
            ?>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                

                 <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                    <?php
                    if(isset($_SESSION["username"])){
                   ?>
                      <img src="<?php echo $_SESSION["photo"]?>" alt class="w-px-40 h-auto rounded-circle" />
                     <?php }
                     else { ?>
                      <img src="../assets/img/avatars/user.png" alt class="w-px-40 h-auto rounded-circle" /><?php
                     } ?>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                                        <?php
                                if(isset($_SESSION["username"])){
                              ?>
                              <img src="<?php echo $_SESSION["photo"]?>" alt class="w-px-40 h-auto rounded-circle" />
                              <?php } 
                              else
                              { ?>
                                <img src="../assets/img/avatars/user.png" alt class="w-px-40 h-auto rounded-circle" />
                              <?php }
                              ?>
                              
                            </div>
                          </div>
                          <div class="flex-grow-1">
                          <?php if (isset($_SESSION["username"])){
                            
                            if (!isset($_SESSION["username"])) {

                              header("location:Home.php");
                            } else {
                              if ($_SESSION["position"] != "user") {
                                header("location:Home.php");
                              }
                            }
                           ?> <span class="fw-semibold d-block"><?php $user=$_SESSION["username"]; echo $_SESSION["Name"]?></span>
                           <small class="text"><?php echo $_SESSION["position"]?> </small>
                           <?php
                          }
                          
                           if (!isset($_SESSION["username"])) {
                            ?> <span class="fw-semibold d-block"><?php  echo "Visitor" ;?></span>
                            <?php
                          }
                          ?>
                          
                        
                          
                          </div>
                        </div>
                      </a>
                      
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <?php
                    if(isset($_SESSION["username"])){
                   ?> <li>
                      <a class="dropdown-item" href="profile.php">
                        <i class="bx bx-user me-2"></i>
                        
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li><?php
                    }
                    else{
                      ?>
                      <a class="dropdown-item" href="../Auth/auth-register-basic.php">
                        <i class="bx bx-user me-2"></i>
                        
                        <span class="align-middle">SignUp</span>
                      </a>
                      <a class="dropdown-item" href="../Auth/auth-login-basic.php">
                        <i class='bx bxs-log-in'></i>
                        
                        <span class="align-middle">Login</span>
                      </a>
                      <?php
                    }
                      ?>
                    
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <?php
                    if(isset($_SESSION["username"])){
                   ?> 
                    <li>
                      <a class="dropdown-item" href="../Auth/auth-login-basic.php?logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                    <?php
                    }
                    ?>
                    
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="col-md-6">
                  <div class="card mb-3">
                      
                          <div class="section-title text-center">
                              <h2>Our Newslatter</h2>
                              <p>We bring the right people together to challenge established thinking and drive transformation.
                                  We will show the way to successive.</p>
                          </div>
                      
                  

          
                  <div class="row justify-content-center">
                  <?php
                      if($errMsg!="")
                {
                    ?>
                        <div class="alert alert-danger" role="alert"><?php echo $errMsg ?></div>
                    <?php
                }
                if($add!="")
                {
                    ?> 
                        <div class="alert alert-success" role="alert"><?php echo $add ?></div>
                    <?php
                }
              ?>
                      <div class="col-xl-7 col-lg-7">
    
                      <form id="formAuthentication" class="newsletter-form" action="Subscribe.php" method="POST">
                          
                      <div class="mb-3">   
                      <label for="username" class="form-label">Your Payemnt</label>    
                            <input type="text" class="form-control" id="CrdCard" name="CrdCard" placeholder="Enter Your Payment" autofocus />
                          </div>
                          <label for="content" class="form-label">package</label>
                          <div class="input-group input-group-merge">
                           
                              <select id="package" name="package" class="form-select form-select-lg">
                                
                                <option value="10$ per Month">10$ per Month</option>
                                <option value="20$ per Year">20$ per Year</option>
                                <option value="50$ Unlimited">50$ Unlimited</option>
                              </select>
                              </div>
                              <button class="btn btn-primary d-grid w-100" type="submit">Subscribe Now</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>

          </div>

             

            <!-- Footer -->
            
<div class="container my-5">

  <!-- Footer -->
  <footer class="footer bg-light">
                  <div class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
                    <div>
                      <a href="Home.php" target="_blank" class="footer-text fw-bolder">CairoNews</a>
                      ©
                    </div>
                  
                      <div class="dropdown dropup footer-link me-3">
                        
                        
                      </div>
                      <a href="../Auth/auth-login-basic.php?logout" class="btn btn-sm btn-outline-danger"><i class="bx bx-log-out-circle"></i> Logout</a>
                    </div>
                  </div>
                </footer>
  <!-- Footer -->

</div>
<!-- End of .container -->
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    

    <!-- Core JS -->
    <!-- build:js ../assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/masonry/masonry.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
