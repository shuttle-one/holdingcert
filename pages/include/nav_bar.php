<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
$color_class = "";
$role = $_SESSION['role'];

if ($role == 1) 
  $color_class = "navbar-trader"; // blue
if ($role == 2) 
  $color_class = "navbar-terminal"; // green
if ($role==3)
  $color_class = "navbar-financier"; // purple

?>

<nav class="navbar default-layout <?=$color_class?> col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="#">
      <img src="../../images/logo-psa.jpg" alt="logo" />
    </a>
    <a class="navbar-brand brand-logo-mini" href="#">
      <img src="../../images/logo-psa.jpg" alt="logo" />
    </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center">
    <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
      <li class="nav-item">
        <a href="dashboard.php" class="nav-link">
          <i class="fa fa-dashboard"></i>
          DASHBOARD
        </a>
      </li>
      <li class="nav-item">
        <a href="tank_list.php" class="nav-link">
          <i class="fa fa-tint"></i>
          TANK
        </a>
      </li>
    </ul>
    
    <ul class="navbar-nav navbar-nav-right">
     
      <li class="nav-item dropdown d-none d-xl-inline-block">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <span class="profile-text" style="text-transform: uppercase;"><?=$_SESSION['username']?></span>
          <img class="img-xs rounded-circle" src="../../images/avatar.png" alt="Profile image">
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
         
          <br>
          <a class="dropdown-item" href="../login/logout.php">
            Sign Out
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>