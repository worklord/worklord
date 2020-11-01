<?php 
//If user Not logged in then redirect them back to homepage. 
if(!empty($_SESSION['id_company']) || !empty($_SESSION['id_user'])) {
  header("Location: ../../index.php");
  exit();
}
session_start();
include 'includes/check_reply.php';
if (isset($_GET['tid'])) {
include '../../db.php';
$task_id = mysqli_real_escape_string($conn, $_GET['tid']);	

$sql = "SELECT * FROM tasks WHERE task_id = '$task_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $task_name =$row['task_name'];
    }
} else {
header("location:./");	
}

}else{
header("location:./");	
}
?>
<!DOCTYPE html>
<html>
    
<head>
<title>WorkLord</title>
<!-- Favicons -->
<link rel="icon" href="../../img/logo.png">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="../../css/AdminLTE.min.css">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/images/icon.png" rel="icon">
        <link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/snack.css" rel="stylesheet" type="text/css"/>
        <script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
/* Customize the label (the container) */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}
</style>
    </head>
	<body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?> >

        <main class="content-wrap">

<header class="main-header">

    <!-- Logo -->
    <a href="../../index.php" class="logo logo-bg">
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
		<li><a href="./">Overview</a></li>
		<li><a href="examinations.php">Examinations</a></li>
		<li><a href="tasks.php">Tasks</a></li>
		<li><a href="results.php">Exam Results</a></li>
		<li><a href="../../logout.php">Logout</a></li>   		  
        </ul>
      </div>
    </nav>
  </header>

            <div class="page-inner">
                <div class="page-title">
                    <h3>Task: <?php echo "$task_name"; ?></h3>
                </div>
                <div id="main-wrapper">
                    <div class="row">
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <div class="tabs-below" role="tabpanel">
                                       
                                            <div class="tab-content">
											<?php 
											include '../../db.php';
											$sql = "SELECT * FROM task_questions WHERE task_id = '$task_id'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            while($row = $result->fetch_assoc()) {
												$qs = $row['question'];
												
                                            
											if ($qno == "1") {
											print '
											<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
                                             <p><b>'.$qno.'.</b> '.$qs.'</p>
											 
											 <hr>
											 <a  class="btn btn-twitter m-b-xs"href="edit-taskquestion.php?id='.$row['question_id'].'"><i class="fa fa-pencil"></i></a>
											 <a';?> onclick = "return confirm('Drop this question ?')" <?php print 'class="btn btn-youtube m-b-xs"href="pages/drop_taskquestion.php?id='.$row['question_id'].'&tid='.$task_id.'"><i class="fa fa-trash-o"></i></a>
											 
                                             </div>
											';	
											}else{
											print '
											<div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">
                                             <p><b>'.$qno.'.</b> '.$qs.'</p>
											 
											 <hr>
											 <a  class="btn btn-twitter m-b-xs"href="edit-taskquestion.php?id='.$row['question_id'].'"><i class="fa fa-pencil"></i></a>
											 <a';?> onclick = "return confirm('Drop this question ?')" <?php print 'class="btn btn-youtube m-b-xs"href="pages/drop_taskquestion.php?id='.$row['question_id'].'&tid='.$task_id.'"><i class="fa fa-trash-o"></i></a>
                                             </div>
											';		
											}

											$qno = $qno + 1;	
											

                                            }
                                            } else {
												echo "No Questions found in Task: $task_name";
												
                                            }
											
											?>

                                            </div>
                 
											
                                            <ul class="nav nav-tabs" role="tablist">
											<?php 
											include '../../db.php';
											$sql = "SELECT * FROM task_questions WHERE task_id = '$task_id'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            while($row = $result->fetch_assoc()) {
											if ($qno == "1") {
											print '<li role="presentation" class="active"><a href="#tab'.$qno.'" role="tab" data-toggle="tab">Q'.$qno.'</a></li>';	
											}else{
											print '<li role="presentation"><a href="#tab'.$qno.'" role="tab" data-toggle="tab">Q'.$qno.'</a></li>';		
											}

											$qno = $qno + 1;
                                            }
                                            } else {
 
                                            }
											
											?>
                      
                                            </ul>
                                        </div>
                                    </div>
                                </div>  
                    </div>
                </div>
                
            </div>
        </main>
		<?php if ($ms == "1") {
?> <div class="alert alert-success" id="snackbar"><?php echo "$description"; ?></div> <?php	
}else{
	
}
?>
        <div class="cd-overlay"></div>
	

        <script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="../assets/plugins/pace-master/pace.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="../assets/plugins/waves/waves.min.js"></script>
        <script src="../assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="../assets/js/modern.min.js"></script>
        
				<script>
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>