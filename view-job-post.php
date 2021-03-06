<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WorkLord</title>
    <!-- Favicons -->
  <link rel="icon" href="img/logo.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo logo-bg">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>W</b>L</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Work</b>Lord</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
      </div>
    </nav>
  </header>



  <div class="content-wrapper" style="margin-left: 0px;">

  <?php
  
    $sql = "SELECT * FROM job_post INNER JOIN company ON job_post.id_company=company.id_company WHERE id_jobpost='$_GET[id]'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) 
    {
      while($row = $result->fetch_assoc()) 
      {
  ?>

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">          
          <div class="col-md-9 bg-white padding-2">
            <div class="pull-left">
              <h2><b><i><?php echo $row['jobtitle']; ?></i></b></h2>
            </div>
            <div class="pull-right">
              <!--<a href="jobs.php" class="btn btn-default btn-lg btn-flat margin-top-20"><i class="fa fa-arrow-circle-left"></i> Back</a>-->
            </div>
            <div class="clearfix"></div>
            <hr>
            <div>
              <p><span class="margin-right-10"><i class="fa fa-location-arrow text-green"></i> <?php echo $row['city']; ?></span> <i class="fa fa-calendar text-green"></i> <?php echo date("d-M-Y", strtotime($row['createdat'])); ?></p>              
            </div>
            <div>
              <?php echo "Description : ".stripcslashes($row['description']); ?>
            </div>
			<div>
              <?php echo "Experience : ".stripcslashes($row['experience'])." Year";  ?>
            </div>
			 <div>
              <?php echo "Qualification : ".stripcslashes($row['qualification']); ?>
            </div>
			<div>
              <?php echo "Due Date : " ?> <?php echo date("d-M-Y", strtotime($row['duedate'])); ?>
            </div>
            <?php 
			if(isset($_SESSION['id_user'])) { 
			
				$sql2 = "SELECT * FROM apply_job_post WHERE id_jobpost='$_GET[id]' and id_user=$_SESSION[id_user]";
				$result2 = $conn->query($sql2);
			
			    if($result2->num_rows > 0) 
				{
					echo "<div style='color:red'>Already Applied</div>";
				}
			
            else if(isset($_SESSION["id_user"])) { ?>
            <div>
              <a href="apply.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-success btn-flat margin-top-50">Apply</a>
            </div>
            <?php }} ?>
			   <?php 
    
    if(isset($_SESSION['jobApplySuccess'])) {
      ?>
			<div class='apply' style='display:none'>Applied Successfully..</div>
    <?php
     unset($_SESSION['jobApplySuccess']); }
    ?>       
          </div>
		  
          <div class="col-md-3">
            <div class="thumbnail">
              <img src="uploads/logo/<?php echo $row['logo']; ?>" alt="companylogo">
              <div class="caption text-center">
                <h3><?php echo $row['companyname']; ?></h3>
                <hr>
                <div class="row">
				<?php 
			if(isset($_SESSION['id_user'])) { 
				$sql2 = "SELECT * FROM apply_job_post WHERE id_jobpost='$_GET[id]' and id_user=$_SESSION[id_user]";
				$result2 = $conn->query($sql2);
			
			    if($result2->num_rows > 0) 
				{
					echo "<div style='color:red'>Already Applied</div>";
				}
            else if(isset($_SESSION["id_user"])) { ?>
                  <div class="col-md-5"><a href="apply.php?id=<?php echo $row['id_jobpost']; ?>"><i class="fa fa-address-card-o"></i> Apply</a></div>
			<?php }} ?>
                  <div class="col-md-5"><a href="mailto:me"><i class="fa fa-envelope"></i> Email</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php 
      }
    }
    ?>

    

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
      <strong>Copyright &copy; 2020 WorkLord.</strong> All rights reserved.
    </div>
  </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<script>
$('.apply').fadeIn(400).delay(3000).fadeOut(400); //fade out after 3 seconds
</script>
</body>
</html>
