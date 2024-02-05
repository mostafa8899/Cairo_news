<?php

session_start();

require_once '../../Models/Article.php';
require_once '../../Models/Comment.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/articleController.php';
require_once '../../Controllers/commentController.php';
require_once '../../Controllers/JokesController.php';
require_once '../../Models/Jokes.php';
require_once '../../Controllers/subscriptionController.php';
require_once '../../Models/Story.php';
require_once '../../Controllers/StoryController.php';

$storyController=new storyController;
$StoryView=$storyController->getStory();

$Sub=new subscriptionController;
$username="";
if(isset($_SESSION["username"])){     
  $username=$_SESSION['username'];
}

$article = new articleController;
$articleS=$article->getCategory($category='sport');
$articleF=$article->getCategory($category='food');
$articleA=$article->getCategory($category='art');
$articleSc=$article->getCategory($category='science');
$articleL=$article->getarticleL();
if($articleL===NULL){
  header("location:Home.php");
}
$errMsg = "";

$user="";
$comm="";

$JokeController=new JokesController;
$jokeView=$JokeController->getJokes();




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

          <ul class="menu-inner py-2">
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
                 <form action="<?php  ?> search.php" method="POST">
                 <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  
            <input type="search" name="search" placeholder="Search for food.." required class="form-control border-0 shadow-none">
            <input type="submit" name="submit" value="search" class="btn rounded-pill btn-dark">
                
                </div>
              </div>
              </form>
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
            <?php 
            if($storyController->getStory()){
              ?>
            <div class="container-xxl flex-grow-1 container-p-y">
  <h4><span class="text-muted fw-light"> Stories</span></h4>

  <div class="stories-container">
  <div class="stories">

  <?php 
  $Nimg=0;  
  
  foreach($StoryView as $story){
    $Nimg++;
    
    $storyController->deleteExpiredStories($story['StoryID']);

    ?>
    <div class="story">
      <img src="<?php echo $story['image'] ?>" alt="Story <?php echo $Nimg ?>">
    </div>
    <?php
  }

  ?>
  </div>
  <div class="navi">
    <button class="prev"><i class="fa fa-chevron-left"></i></button>
    <button class="next"><i class="fa fa-chevron-right"></i></button>
  </div>
</div>


</div>
<?php }
?>
                
              
       
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Latest News</span></h4>

              <!-- Examples -->
              <div class="row mb-3 ">
  <?php
  foreach ($articleL as $article ) {
  ?>
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-95">
        <img class="card-img-top" src="<?php echo $article['image'] ?>" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title"><?php echo $article['category'] ?></h5>
          <p class="card-text">
            <small class="text-muted"><?php echo $article['Content'] ?></small>
          </p>
          <a href="thearticle.php?articleID=<?php echo $article['ArticleID'] ?>" class="btn rounded-pill btn-dark">Details</a>
          <div class="col-xxl">
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</div>
                
              
              <!-- Examples -->

            

              <!-- Images -->
              <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sports</span></h4>

              <!-- Examples -->
              <div class="row mb-3 ">
  <?php
  foreach ($articleS as $article ) {
  ?>
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="<?php echo $article['image'] ?>" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title"><?php echo $article['category'] ?></h5>
          <p class="card-text">
            <small class="text-muted"><?php echo $article['Content'] ?></small>
          </p>
          <a href="thearticle.php?articleID=<?php echo $article['ArticleID'] ?>" class="btn rounded-pill btn-dark">Details</a>
          <div class="col-xxl">
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</div>
                  
                </div>
              <!--/ Images -->

              <!-- Horizontal -->
              <h5 class="pb-1 mb-4">About Art</h5>
              <div class="row mb-3 ">
  <?php
  foreach ($articleA as $article ) {
  ?>
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="<?php echo $article['image'] ?>" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title"><?php echo $article['category'] ?></h5>
          <p class="card-text">
            <small class="text-muted"><?php echo $article['Content'] ?></small>
          </p>
          <a href="thearticle.php?articleID=<?php echo $article['ArticleID'] ?>" class="btn rounded-pill btn-dark">Details</a>
          <div class="col-xxl">
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</div>
                  
                </div>
              <!--/ Horizontal -->
              <!-- Horizontal -->
              <h5 class="pb-1 mb-4">Jokes</h5>
              <div class="row mb-3 ">
  <?php
  foreach ($jokeView as $jokes ) {
  ?>
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100">
        
        <div class="card-body">
          <h5 class="card-title"><?php echo $jokes['Content'] ?></h5>
          <p class="card-text">
            
          </p>
          
          
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</div>
                  
                
              <!--/ Horizontal -->




               <!-- Horizontal -->
               <h5 class="pb-1 mb-4">About Business</h5>
               <div class="row mb-5">
                <div class="col-12 mb-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="position: relative;">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                          <div class="card-title">
                            <h5 class="text-nowrap mb-2">Profile Report</h5>
                            <span class="badge bg-label-warning rounded-pill">Year 2023</span>
                          </div>
                          <div class="mt-sm-auto">
                            <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> 68.2%</small>
                            <h3 class="mb-0">$84,686k</h3>
                          </div>
                        </div>
                        <div id="profileReportChart" style="min-height: 80px;"><div id="apexchartsobgdrnvf" class="apexcharts-canvas apexchartsobgdrnvf apexcharts-theme-light" style="width: 300px; height: 80px;"><svg id="SvgjsSvg2157" width="300" height="80" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG2159" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs2158"><clipPath id="gridRectMaskobgdrnvf"><rect id="SvgjsRect2164" width="301" height="85" x="-4.5" y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskobgdrnvf"></clipPath><clipPath id="nonForecastMaskobgdrnvf"></clipPath><clipPath id="gridRectMarkerMaskobgdrnvf"><rect id="SvgjsRect2165" width="296" height="84" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><filter id="SvgjsFilter2171" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood2172" flood-color="#ffab00" flood-opacity="0.15" result="SvgjsFeFlood2172Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite2173" in="SvgjsFeFlood2172Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite2173Out"></feComposite><feOffset id="SvgjsFeOffset2174" dx="5" dy="10" result="SvgjsFeOffset2174Out" in="SvgjsFeComposite2173Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur2175" stdDeviation="3 " result="SvgjsFeGaussianBlur2175Out" in="SvgjsFeOffset2174Out"></feGaussianBlur><feMerge id="SvgjsFeMerge2176" result="SvgjsFeMerge2176Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode2177" in="SvgjsFeGaussianBlur2175Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode2178" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend2179" in="SourceGraphic" in2="SvgjsFeMerge2176Out" mode="normal" result="SvgjsFeBlend2179Out"></feBlend></filter></defs><line id="SvgjsLine2163" x1="0" y1="0" x2="0" y2="80" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="80" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG2180" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG2181" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG2189" class="apexcharts-grid"><g id="SvgjsG2190" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine2192" x1="0" y1="0" x2="292" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2193" x1="0" y1="20" x2="292" y2="20" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2194" x1="0" y1="40" x2="292" y2="40" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2195" x1="0" y1="60" x2="292" y2="60" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2196" x1="0" y1="80" x2="292" y2="80" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG2191" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine2198" x1="0" y1="80" x2="292" y2="80" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine2197" x1="0" y1="1" x2="0" y2="80" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG2166" class="apexcharts-line-series apexcharts-plot-series"><g id="SvgjsG2167" class="apexcharts-series" seriesName="seriesx1" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath2170" d="M 0 76C 20.44 76 37.96000000000001 12 58.400000000000006 12C 78.84 12 96.36000000000001 62 116.80000000000001 62C 137.24 62 154.76000000000002 22 175.20000000000002 22C 195.64000000000001 22 213.16000000000003 38 233.60000000000002 38C 254.04000000000002 38 271.56 6 292 6" fill="none" fill-opacity="1" stroke="rgba(255,171,0,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="5" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMaskobgdrnvf)" filter="url(#SvgjsFilter2171)" pathTo="M 0 76C 20.44 76 37.96000000000001 12 58.400000000000006 12C 78.84 12 96.36000000000001 62 116.80000000000001 62C 137.24 62 154.76000000000002 22 175.20000000000002 22C 195.64000000000001 22 213.16000000000003 38 233.60000000000002 38C 254.04000000000002 38 271.56 6 292 6" pathFrom="M -1 120L -1 120L 58.400000000000006 120L 116.80000000000001 120L 175.20000000000002 120L 233.60000000000002 120L 292 120"></path><g id="SvgjsG2168" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle2204" r="0" cx="0" cy="0" class="apexcharts-marker w1j027kqdh no-pointer-events" stroke="#ffffff" fill="#ffab00" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG2169" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine2199" x1="0" y1="0" x2="292" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2200" x1="0" y1="0" x2="292" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG2201" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG2202" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG2203" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect2162" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG2188" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG2160" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 40px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 171, 0);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                      <div class="resize-triggers"><div class="expand-trigger"><div style="width: 498px; height: 116px;"></div></div><div class="contract-trigger"></div></div></div>
                    </div>
                  </div>
                </div>

                
               </div>
               <!--/ Horizontal -->
 

             

              <!-- Card layout -->
              <h5 class="pb-1 my-5">About Science</h5>

              <!-- Card Groups -->
              <!-- <h6 class="pb-1 mb-4 text-muted">Card Groups</h6> -->
              <div class="row mb-3 ">
  <?php
  foreach ($articleSc as $article ) {
  ?>
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="<?php echo $article['image'] ?>" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title"><?php echo $article['category'] ?></h5>
          <p class="card-text">
            <small class="text-muted"><?php echo $article['Content'] ?></small>
          </p>
          <a href="thearticle.php?articleID=<?php echo $article['ArticleID'] ?>" class="btn rounded-pill btn-dark">Details</a>
          <div class="col-xxl">
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</div>
                  
                </div>

              <!-- Grid Card -->
              <h5 class="pb-1 my-5">About Food</h5>
              <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
              <?php
  foreach ($articleF as $article ) {
  ?>
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="<?php echo $article['image'] ?>" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title"><?php echo $article['category'] ?></h5>
          <p class="card-text">
            <small class="text-muted"><?php echo $article['Content'] ?></small>
          </p>
          <a href="thearticle.php?articleID=<?php echo $article['ArticleID'] ?>" class="btn rounded-pill btn-dark">Details</a>
          <div class="col-xxl">
          </div>
        </div>
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
