<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sailor Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Sailor - v3.0.0
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Sailor</a></h1>
      <nav class="nav-menu d-none d-lg-block">

        <ul>
          <li class="active"><a href="index.php">Home</a></li>

         <!-- <li class="drop-down"><a href="#">Services</a>
            <ul> -->
              <li><a href="wordEntry.php">Dictionary</a></li>
              <li><a href="blog.php">Articles</a></li>
          <!--    <li><a href="acronymSearch.php">Acronyms</a></li>  -->
           <!--   <li><a href="testimonials.html">Monthly Analysis</a></li> -->
       <!--     </ul>
          </li> -->
  <!--        <li><a href="blog.html">Blog</a></li> -->
  <!--        <li><a href="contact.html">Contact</a></li> -->
  <!--         <li><a href="services.html">Services2</a></li>  -->
          <li class="drop-down"><a href="#">Acronyms</a>
            <ul>
            <li><a href="acronymSearch.php">Search Acronym</a></li> 
          <?php
          include_once "Users.php";
          $user= new Users;
          $rs=$user->GetUser();
          if($row=mysqli_fetch_assoc($rs))
            {
             if($row['specialization']!="NotSelected")
             {
          ?>
               <li><a href="acronymAdmin.php">Add Acronym</a></li>
               <li><a href="showAcronyms.php">My Acronyms</a></li>
         <?php    }}
          ?> 
          
          </ul>
          </li>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="myProfile.php">My Profile</a></li>
  <!--      <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="pricing.html">Pricing</a></li>
    -->
        </ul>

      </nav><!-- .nav-menu -->
      <a href="myProfile.php" class="get-started-btn p-2"><i class='fas fa-user-circle mx-1'></i><?php echo($_SESSION["userName"])?></a>

    </div>
  </header><!-- End Header -->
