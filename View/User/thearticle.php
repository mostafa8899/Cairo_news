<?php

session_start();

require_once '../../Models/Article.php';
require_once '../../Models/Comment.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/articleController.php';
require_once '../../Controllers/commentController.php';
require_once '../../Controllers/save_post.php';
require_once '../../Models/Save.php';
require_once '../../Controllers/LikeController.php';
require_once '../../Controllers/subscriptionController.php';
$Sub=new subscriptionController;
if(isset($_SESSION["username"])){     
  $username=$_SESSION['username'];
}


$n=0;

$errMsg = "";

$user="";
$ar;




if (isset($_GET['articleID'])) {
 
  $_SESSION['articleID'] = $_GET['articleID'];
  
}
if (isset($_SESSION['articleID'])) {
  $articleID = $_SESSION['articleID'];
  $articleController = new articleController;
  $commentController = new commentController;
  $commentView=$commentController->getAllComments($_SESSION['articleID']);
  $articleView=$articleController->getArticle($_SESSION['articleID']);
  // do something with $articleID
} else {
  // handle case where articleID is not set
}

$deleteMsg = false;
if (isset($_POST["delete"])) {
  if (!empty($_POST["CID"])) {
    if ($commentController->deleteComment($_POST["CID"])) {
      $deleteMsg = true;
      $commentView=$commentController->getAllComments($_SESSION['articleID']);
      // header("location:thearticle.php?articleID={$_SESSION['articleID']}");
    }
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['content'])) {
  if (!empty($_POST['content'])) {
    $comment = new Comment;
    $commentController = new commentController;
  
    // $comment->username=$user;
    $comment->setArticleID($_SESSION['articleID']);
    $comment->setUsername($_SESSION['username']);
    $comment->Content = $_POST['content'];
  
    if ($commentController->sendComment($comment)) {
       $commentView=$commentController->getAllComments($_SESSION['articleID']);
       header("location:thearticle.php?articleID={$_SESSION['articleID']}");
       

    } else {
      $errMsg = $_SESSION["errMsg"];

    }
  }
}
$saved ="";

//Save Link_________________
$msg=false;
if (isset($_POST['save'])) {
  $save = new Save;
  $save_post = new save_post;

  $save->link_url="thearticle.php?articleID={$_SESSION['articleID']}";
  $save->SetArticleID($_SESSION['articleID']);
  $save->setusername($_SESSION['username']);
  
  if ($save_post->AddSave($save)) {
      $msg = true;
  } 
  else {
      // Check if saved post exists for this user and article
      $saved_post = $save_post->getAllSave($_SESSION['username']);
      if ($saved_post) {
          // Saved post exists, delete it
          if ($save_post->deleteSave($save)) {
              $msgdelete = true;
          }
      }
  }
}
//Save Link______________________
// Delete Save..................

$Dsave = new Save;
$Dsave_post = new save_post;
if(isset($_SESSION["username"])){
 
$Dsave->setusername($_SESSION['username']);
}
$Dsave->SetArticleID($_SESSION['articleID']);
$Dsave->link_url="thearticle.php?articleID={$_SESSION['articleID']}";
$deleteSave = false;
if (isset($_POST["DeleteSave"])) {
 
    if ($Dsave_post->deleteSave($Dsave)) {
      $deleteSave = true;
      
      // header("location:thearticle.php?articleID={$_SESSION['articleID']}");
    }
  
}





//Delte Save ............................




$likeController = new LikeController;
$likesview=$likeController->getLike($_SESSION['articleID']);

//Like_______________________
  $msgdelete=FALSE;
  $likemsg=false;
 if ( isset($_POST['Like'])) {
   
  
   
 
   
   $ArticleID = $_SESSION['articleID'];
   $UserName = $_SESSION['username'];
  
 
   if ($likeController->AddLike($UserName,$ArticleID)) {
    header("location:thearticle.php?articleID={$_SESSION['articleID']}");
     $likemsg=True;
      
 
      
 
   } 
   else {
     if($likeController->deleteLike($ArticleID,$UserName)){
      header("location:thearticle.php?articleID={$_SESSION['articleID']}");
       $msgdelete=True;
        
     }
     
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
            <!-- Home -->
            <li class="menu-item active">
              <a href="Home.php" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Home</div>
              </a>
            </li>

            <!-- Categories -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Categories</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
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
            <li class="menu-item">
              <a href="https://www.nytimes.com/crosswords" class="menu-link">
              <i class='bx bxs-game' ></i>
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
              <i class='bx bx-message-detail' > </i>
                <div data-i18n="Support">Feedback</div>
              </a>
            </li>
             
            
            <li class="menu-item">
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
            
             <div class="posty">
              <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-6">
                          <div class="card-body">
                                          <?php
                                  foreach ($articleView as $article) {
                                    
                                  ?>
                                <h5 class="card-title"><?php echo $article['category'] ?></h5>
                                <p class="card-text">
                                <?php echo $article['Content'] ?>
                                </p>
                                <p class="card-text"><small class="text-muted"><?php echo date('l, F j, Y g:i A', strtotime($article['DateAdded'])) ?></small></p>
                              </div>
                            </div>
                              <div class="col-md-4">
                                <img class="card-img-top" src="<?php echo $article['image'] ?>" alt="Card image cap" />
                            </div>
                            
                          </div>
                      <div class="mb-3 row">
                      
                          <footer class="bg-body-light">
                          
                            <ul class="post-links">
                              <?php
                            if(isset($_SESSION["username"])){
                             ?> 
                            <form id="formAuthentication"  action="thearticle.php?id" method="POST">           
                            <button type="submit" name="Like" class="btn btn-primary" >Like</button> 
                            
                            </form>
                           <?php
                            }
                            ?>
                             
                            <li><a href="#"><span class="text-danger"><i class="fa fa-heart"></i> <?php foreach($likesview as $like){
                              echo $like['likes']."like"; 
                            } ?></span></a></li>

                            <?php
                            if(isset($_SESSION["username"])){
                             ?> 
                                <form id="formAuthentication"  action="thearticle.php?id" method="POST">  
                
                <button type="submit" name="save" class="btn btn-primary" style="margin-left:90%;" >Save</button> 
                 </form>
                 <?php if($Dsave_post->getSavedPost($Dsave)){
                  ?>
                      <form id="formAuthentication"  action="thearticle.php?id" method="POST">         
                
                <button type="submit" name="DeleteSave" class="btn btn-primary" style="margin-left:93%;" >Unsave</button> 
                 </form>
                 <?php
                 }
                }
                 ?>
                            </ul>
                            <a href="https://www.facebook.com/"  target="_blank"><i class='bx bxl-facebook'></i></a>
                          <a href="https://twitter.com/?lang=ar"  target="_blank"><i class='bx bxl-twitter'></i></a>
                          <a href="https://twitter.com/?lang=ar"  target="_blank"><i class='bx bxl-whatsapp'></i></a>
                          </footer>
                          
                          
                    
                  </div>
                </div>
              </div>
              
              
              <?php
              }
              ?>
              
                  <!-- Comment View -->
            
            <div class="comment-section">
              
              <i class="la la-plus"></i>
              
              <?php
               
              
                 
              
              foreach ($commentView as $comment) {
                
                $n+=1;
                
                
                
              ?>
              <div class="comment-sec">
             
              
              <div class="comment">
                
              <h3><?php echo $comment['username'] ?></h3>
              <span><img src="images/clock.png" alt=""> <?php echo date('l, F j, Y g:i A', strtotime($comment['DateAdded'])) ?></span>
              <p><?php echo $comment['content'] ?></p>
              
              </div>
              
              </div>
              <?php if(isset($_SESSION["username"])){
              if($comment['username']==$_SESSION['username']) { 
                ?>  
              <form id="formAuthentication"  action="thearticle.php?id" method="POST">         
                <input type="hidden" id="CID" name="CID" value="<?php echo $comment['CID'] ?>">
                <button type="submit" name="delete" class="btn btn-primary" style="margin-left:90%;" >Delete</button> 
                 </form>
                   
                 <?php
                 } 
              }
            }
            if($n==0){
              echo "No Comments yet";
            }
              ?>
              
              
              
              
              </div>
              
                    
                   
                    

                    
                  
              
                    <!-- Comment View -->
                    <!-- Functiion Comment -->
                    <?php
                    
                    ?>
                    <!-- Functiion Comment -->
                    <?php
            if(isset($_SESSION["username"])){
                 ?> 
                    <div class="post-comment">
                    
                      <div class="comment_box">

                        <form id="formAuthentication" class="card-body" action="thearticle.php?id" method="POST">
                          <input type="text" id="content" name="content" placeholder="Post a comment">
                          <button type="submit">Send</button>
                        </form>
                      
                    </div>
                    </div>   
                    <?php
            } ?>
                    <?php
            if ($deleteMsg == true||$msgdelete==true||$deleteSave==true) {
              ?>
                <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 translate-middle-x show bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-trash me-2"></i>
                    <div class="me-auto fw-semibold">Deleted Succesfully</div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                </div>
  
              <?php
  
              }
  
              ?>  
                          <?php
            if ($likemsg == true) {
            ?>
              <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 translate-middle-x show bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                  <i class="bx bx-trash me-2"></i>
                  <div class="me-auto fw-semibold">liked</div>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>

            <?php

            }
            

            ?>
                          <?php
            if ($msg == true) {
            ?>
              <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 translate-middle-x show bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                  <i class="bx bx-trash me-2"></i>
                  <div class="me-auto fw-semibold">Saved Succesfully</div>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>

            <?php

            }
            

            ?>

<?php
            if ($saved!="") {
            ?>
              <div data-delay="2000" class="bs-toast toast  fade toast-placement-ex bottom-0 start-50 translate-middle-x show bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                  <i class="bx bx-trash me-2"></i>
                  <div class="me-auto fw-semibold">Already Saved</div>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>

            <?php

            }
            

            ?>
                    
                    
                    
                    
                    
                    
                    
                
                

             
              
              
             

         
          
          
          
            
            
           
            
            
            
                  
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
    <script src="../assets/vendor/js/sub.js"></script>
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
