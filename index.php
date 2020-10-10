<?php

session_start();

require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>WorkLord</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" href="img/logo.png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/darkly/bootstrap.min.css">

  <!-- Vendor CSS Files -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/venobox/venobox.css" rel="stylesheet">
  <link href="vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="css/style.css" rel="stylesheet">
  
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex flex-column justify-content-center">

    <nav class="nav-menu">
      <ul>
        <li class="active"><a href="#hero"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <?php if((empty($_SESSION['id_company']))&&(empty($_SESSION['id_user']))&&(empty($_SESSION['loginid']))) { ?>
          <li><a href="login.php"><i class="bx bx-user"></i> <span>Login</span></a></li>
          <li><a href="sign-up.php"><i class="bx bx-pen"></i> <span>Signup</span></a></li>
          <?php } else { 

            if(isset($_SESSION['id_user'])) { 
          ?>
		  <li><a href="user/index.php"><i class="bx bxs-dashboard"></i> <span>Dashboard</span></a></li>
          <?php
          } else if(isset($_SESSION['id_company'])) { 
          ?>
		  <li><a href="company/index.php"><i class="bx bxs-dashboard"></i> <span>Dashboard</span></a></li>
		  <?php
		  } else if(!(isset($_SESSION['id_user'])) || !(isset($_SESSION['id_user']))) {
			?>
			<li><a href="admin/index.php"><i class="bx bxs-dashboard"></i> <span>Dashboard</span></a></li>
          <?php } ?>
		  <li><a href="logout.php"><i class="bx bxs-exit"></i> <span>Logout</span></a></li>
          <?php } ?>  
        <li><a href="#jobs"><i class="bx bx-search"></i> <span>Jobs</span></a></li>
        <li><a href="#about"><i class="bx bxs-info-circle"></i> <span>About us</span></a></li>
      </ul>
    </nav><!-- .nav-menu -->

  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center">
    <div class="container" data-aos="zoom-in" data-aos-delay="100">
      <h1>WorkLord</h1>
      <p>WorkLord is <span class="typed" data-typed-items="here for you, searching job for you, waiting, giving you opportunities"></span></p>
    </div>
  </section><!-- End Hero -->
  
      <!-- ======= jobs Section ======= -->
    <section id="jobs" class="jobs">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Jobs</h2>
		   <div class="row">
          <div class="col-md-12 text-center index-head">
            <h1>“If you can <strong>DREAM</strong> it, you can DO it ”</h1>
            <p><a class="btn btn-success btn-lg" href="jobs.php" role="button">Search Jobs</a></p>
          </div>
        </div>
		  </div>

        <div class="row">
          <div class="col-md-12 latest-job margin-bottom-20">

            <?php 
          /* Show any 4 random job post */
          $sql = "SELECT * FROM job_post Order By Rand() Limit 4";
          $result = $conn->query($sql);
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
              $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
              $result1 = $conn->query($sql1);
              if($result1->num_rows > 0) {
                while($row1 = $result1->fetch_assoc()) 
                {
             ?>
            <div class="clearfix">
              <div>
                <h4><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a> <span class="pull-right">₹<?php echo $row['maximumsalary']; ?>/Month</span></h4>
                <div>
                    <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
                </div>
              </div>
            </div>
          <?php
              }
            }
            }
          }
          ?>
          </div>
        </div>
      </div>
    </section><!-- End job Section -->
	
  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <p>WORK LORD is a web based application to give the job seekers a platform for finding right and satisfactory job according to their qualification and skills. It also connect the job seekers with the major companies.</p>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <img src="img/logo.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content">
            <p>
              WORKLORD project is aimed at developing a job portal for job seekers.The system project is an online web application which can be accessed anywhere only with proper login provided. Job seekers should be able to login and upload their resume. There are many job portals that claims to provide you the best job, but none of them address the issues faced by the job seekers.They give higher priority for experienced job seekers. They are not calculating the skill level of the job seekers. In this project we requests the Job Seeker to complete the tests provided by admin which helps employer to understand their skills in their fields. Also they will be getting tasks to complete for measuring their performance and efficiency. Most scored/skilled persons will get faster job opportunities Options such as Notice period, preferred employer, preferred technology, preferred domain should be there.Calculating skills will be a great option for freshers to seek jobs.
            </p>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->
    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
         <strong>Copyright &copy; 2020 WorkLord </strong>.</Strong> All rights reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="vendor/counterup/counterup.min.js"></script>
  <script src="vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="vendor/venobox/venobox.min.js"></script>
  <script src="vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="vendor/typed.js/typed.min.js"></script>
  <script src="vendor/aos/aos.js"></script>
  <!-- Template Main JS File -->
  <script src="js/main.js"></script>
</body>
</html>
