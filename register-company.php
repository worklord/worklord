<?php
session_start();

if(isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) { 
  header("Location: index.php");
  exit();
}
require_once("db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WorkLord</title>
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
<body class="hold-transition skin-green sidebar-mini">
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
        <ul class="nav navbar-nav">
          <li>
            <a href="login.php">Login</a>
          </li>       
        </ul>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">

    <section class="content-header">
      <div class="container">
        <div class="row latest-job margin-top-50 margin-bottom-20 bg-white">
          <h1 class="text-center margin-bottom-20">CREATE COMPANY PROFILE</h1>
          <form method="post" id="registerCompanies" action="addcompany.php" onsubmit="return validation()" enctype="multipart/form-data">
            <div class="col-md-6 latest-job ">
              <div class="form-group">
                <input class="form-control input-lg" type="text" name="name" placeholder="Full Name" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" name="companyname" placeholder="Company Name" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" name="website" placeholder="Website">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="email" name="email" placeholder="Email" required>
              </div>
			  <?php if(isset($_SESSION['uploadError'])) { ?>
              <div class="form-group">
                  <label style="color: red;"><?php echo $_SESSION['uploadError']; ?></label>
              </div>
              <?php unset($_SESSION['uploadError']); } ?>
              <div class="form-group">
                <input class="form-control input-lg" type="text" name="contactno" placeholder="Phone Number" minlength="10" maxlength="10" autocomplete="off" onkeypress="return validatePhone(event);" required>
              </div>
              <div class="form-group">
                <textarea class="form-control input-lg" rows="4" name="aboutme" placeholder="Brief info about your company"></textarea>
              </div>
              <div class="form-group checkbox">
                <label><input type="checkbox" required>i accept <a href="terms.php"> terms & conditions</a></label>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-flat btn-success">Register</button>
              </div>
            </div>
            <div class="col-md-6 latest-job ">
              <div class="form-group">
			  
                <input class="form-control input-lg" type="password" name="password" placeholder="Password " required>
				 <label style="color: red;">*Your password must include:</label><br>
				 <label style="color: red;">*be a minimum of 8 characters.</label>
				 <label style="color: red;">*include atleast one of the following mix of characters types:</label>
				   <label style="color: red;"/>&nbsp;&nbsp;&nbsp;uppercase,lowercase,numbers,special symbols.</label>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="password" name="cpassword" placeholder="Confirm Password" required>
              </div>
              <div class="form-group">
                <select class="form-control  input-lg" id="country" name="country" required>
                <option selected="" value="">Select Country</option>
                <?php
                  $sql="SELECT * FROM countries";
                  $result=$conn->query($sql);

                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<option value='".$row['name']."' data-id='".$row['id']."'>".$row['name']."</option>";
                    }
                  }
                ?>
                  
                </select>
              </div>  
              <div id="stateDiv" class="form-group" style="display: none;">
                <select class="form-control  input-lg" id="state" name="state" required>
                  <option value="" selected="">Select State</option>
                </select>
              </div>   
              <div id="cityDiv" class="form-group" style="display: none;">
                <select class="form-control  input-lg" id="city" name="city" >
                  <option selected="">Select City</option>
                </select>
              </div>
              <div class="form-group">
                <label>Attach Company Logo</label>
                <input type="file" name="image" id="image" class="form-control input-lg" onchange="return fileValidation()" required>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
      <strong>Copyright &copy; 2020 WorkLord</a>.</strong> All rights
    reserved.
    </div>
  </footer>
</div>

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>

<script type="text/javascript">
      function validatePhone(event) {
        var key = window.event ? event.keyCode : event.which;

        if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
          return true;
        } else if( key < 48 || key > 57 ) {
          return false;
        } else return true;
      }
	   function validation()
	  {
		  var s=registerCompanies.state.value;
		  var c=registerCompanies.city.value;
		  var cn=registerCompanies.country.value;
		  var p=registerCompanies.password.value;
		  var cp=registerCompanies.cpassword.value;
		  var letters=/^[A-Za-z]+$/;
		   if(p.match(/[a-z]/g) && p.match(/[A-Z]/g) && p.match(/[0-9]/g) && p.match(/[^a-zA-Z\d]/g) && p.length >=8)
		  {
		      return true;
		  }
		  else
		  {
			alert("password require minimum 8 characters with atleast one Uppercase,one Lowercase and one Special character");	
            return	false;		
		  }
		  if(p != cp)
		  {
			  alert("Password does not matches");
			  return false;
		  }
	     if(s.match(letters) && c.match(letters) && cn.match(letters) )
		  {
			return true;
		  }
          else
		  {
			  alert("City,State and Country must have alphabet characters only ");
           	return false;
		  }			
	  }
</script>

<script>
  $("#country").on("change", function() {
    var id = $(this).find(':selected').attr("data-id");
    $("#state").find('option:not(:first)').remove();
    if(id != '') {
      $.post("state.php", {id: id}).done(function(data) {
        $("#state").append(data);
      });
      $('#stateDiv').show();
    } else {
      $('#stateDiv').hide();
      $('#cityDiv').hide();
    }
  });
</script>

<script>
  $("#state").on("change", function() {
    var id = $(this).find(':selected').attr("data-id");
    $("#city").find('option:not(:first)').remove();
    if(id != '') {
      $.post("city.php", {id: id}).done(function(data) {
        $("#city").append(data);
      });
      $('#cityDiv').show();
    } else {
      $('#cityDiv').hide();
    }
  });
</script>
    <script> 
        function fileValidation() { 
            var fileInput =  
                document.getElementById('image'); 
              
            var filePath = fileInput.value; 
          
            // Allowing file type 
            var allowedExtensions =  
/(\.png|\.jpeg|\.jpg)$/i; 
              
            if (!allowedExtensions.exec(filePath)) { 
                alert('Invalid file type'); 
                fileInput.value = ''; 
                return false; 
            }  
		const fi = document.getElementById('image'); 
        // Check if any file is selected. 
        if (fi.files.length > 0) { 
            for (const i = 0; i <= fi.files.length - 1; i++) { 
  
                const fsize = fi.files.item(i).size; 
                const file = Math.round((fsize / 1024)); 
                // The size of the file. 
                if (file >= 1024) { 
                    alert( 
                      "File too Big, please select a file less than 4mb"); 
					  fi.value = ''; 
					  return false; 
                }
            } 
        }
        } 
    </script> 
</body>
</html>
