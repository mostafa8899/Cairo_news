<?php
session_start();
if (!isset($_SESSION["username"])) {

  header("location:../Auth/auth-login-basic.php ");
} else {
  if ($_SESSION["position"] != "author") {
    header("location:../Auth/auth-login-basic.php");
  }
}
require_once '../../Models/Article.php';
require_once '../../Controllers/articleController.php';
require_once '../../Controllers/Author_articleController.php';

if(!isset($_SESSION["position"]))
{
  session_start();
}
$add="";
$errMsg="";
if (isset($_POST['Content']) && isset($_POST['category']) &&  isset($_FILES["image"]))  
{
  if (!empty($_POST['Content']) && !empty($_POST['category'])) 
  {
$article=new articles;
$articleController=new articleController;
$article->Content=$_POST['Content'];
$article->category=$_POST['category'];
$location="../images/".date("h.i.s").$_FILES["image"]["name"];

          if(move_uploaded_file($_FILES["image"]["tmp_name"],$location))
              {
                  $article->image=$location;
                if($articleController->addarticle($article))
                  {
                    $Author_articleController = new Author_articleController;

                    if ($lastArticleID=$Author_articleController->lastrow()) {
                
                      $username = $_SESSION['username'];

                          if($Author_articleController->insert($username,$lastArticleID))
                          {
                            header("location:author.php");
                            $add="added sucessfuly";
                          }
                          else{
                            $errMsg=$_SESSION["errMsg"];
                            }
                          }
                          else{
                          $errMsg="unfound";
                        }
                      $add="added sucessfuly";
                      // copy('ar1artical.php',_DIR_.'C:\xampp\htdocs\projects\html new_1\User\ar1artical.php');
                      }
                      else{
                      $errMsg=$_SESSION["errMsg"];
                      }
          }
          
          else{
            $errMsg="Error in upload";
          }
          } 
  else{
    $errMsg="please fill all fields";
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

    <title>CairoNews-Author</title>

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

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

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
            <li class="menu-item active">
              <a href="author.php" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Author Page</div>
              </a>
            </li>
            <li class="menu-item ">
              <a href="ArticleAuthor.php" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Articles Page</div>
              </a>
            </li>

            

            
          </ul>
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
                      <img src="<?php echo $_SESSION["photo"]?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?php echo $_SESSION["photo"]?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                          <span class="fw-semibold d-block"><?php echo $_SESSION["Name"]?></span>
                          <small class="text"><?php echo $_SESSION["position"]?> </small>
                          
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="profile.php">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../Auth/auth-login-basic.php?logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><span> ADD Article</h4>
             
              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Articles</h5>
                     
                    </div>
                    <div class="card-body">
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








                      <form id="formAuthentication" class="card-body" action="author.php" method="POST"enctype="multipart/form-data" >
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="Content">Content</label>
                           <div class="col-sm-10">
                             <textarea type="text" class="form-control" id="Content" name="Content">  </textarea>
                           </div>
                  
                         <div class="row mb-3">
                           <label class="col-sm-3 form-label" for="category">Category</label>
                           <div class="col-sm-9">
                               <div class="input-group input-group-merge">
                                   <select id="category" class="form-select form-select-lg" name="category">
                            
                                   <option value="food">food</option>
                                   <option value="art">art</option>
                                   <option value="science">science</option>
                                    <option value="sport">sport</option>
                              



                                </select>
                              </div>
                           </div>
                      </div>
                         <div class="row mb-3">
                           <label class="col-sm-3 form-label" for="image">image</label>
                           <div class="col-sm-9">
                               <div class="input-group input-group-merge">

                                   <input class="form-control" type="file" id="formFile" name="image" />
                               </div>
                           </div>
                      </div>
                      <div class="row justify-content-end">
                           <div class="col-sm-10">
                               <button type="submit" class="btn btn-primary">Add</button>
                          </div>

                       </form> 
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
