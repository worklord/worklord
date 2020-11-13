<?php 

session_start();
include 'includes/fetch_records.php';

if(!empty($_SESSION['id_company']) || !empty($_SESSION['id_user'])) {
  header("Location: ../../index.php");
  exit();
}

if (isset($_GET['rid'])) {
include '../../db.php';	
$assess_id = mysqli_real_escape_string($conn, $_GET['rid']);
$task_id = mysqli_real_escape_string($conn, $_GET['tid']);
$record_found = 0;
$sql = "SELECT * FROM tasks,task_assessment_records,task_questions WHERE ( task_questions.task_id='$task_id' && tasks.task_id='$task_id' &&  task_assessment_records.task_id='$task_id') && record_id = '$assess_id' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
	$task_name = $row['task_name'];
	$task_question = $row['question'];
	$passmark = $row['passmark'];
	$terms = $row['terms'];
	$status = $row['status'];

	if ($status == !0) {
	header("location:./");	
	}
    }
} else {
header("location:./");	
}






$conn->close();
}else{

header("location:./");	
}

 ?>
<!DOCTYPE html>
<html>
    
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/images/icon.png" rel="icon">
        <link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        		
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        
    </head>
    <body>
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
		<li><a href="reviewtask.php">Review Task</a></li>
		<li><a href="../../logout.php">Logout</a></li>   		  
        </ul>
      </div>
    </nav>
  </header>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Take Assessment</h3>
                </div>
                <div id="main-wrapper">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                          
                                <div class="row">
                           <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Task Properties</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive project-stats">  
                                       <table class="table">
                                           </thead>
                                           <tbody>
                                               <tr>
                                                   <th scope="row">1</th>
                                                   <td>Task Name</td>
                                                   <td><?php echo "$task_name"; ?></td>
                                               </tr>

											   <tr>
                                                   <th scope="row">2</th>
                                                   <td>Passmark</td>
                                                   <td><?php echo "$passmark"; ?>%</td>
                                               </tr>
											   
											   
                                              
                                           </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
   
                                </div>
                           
                        </div>
						
                           <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Question</h3>
                                </div>
                                <div class="panel-body">
                                    <?php echo "$task_question"; ?>
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Task Github Link</h3>
                                </div>
								 
                                <div class="panel-body">
								 <form action="pages/update_taskscore.php" method="POST" name="task" id="task_form" >
								<div class="form-group">
								<?php 
											include '../../db.php';
											$sql = "SELECT * FROM task_assessment_records WHERE task_id = '$task_id' && record_id='$assess_id'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            while($row = $result->fetch_assoc()) {
												$link = $row['link'];

											print '
											<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
											 <p><textarea style="resize: none;"  rows="2" name="link"  class="form-control" readonly="readonly" autocomplete="off">'.$link.'</textarea>
											 
											 
                                             </div>
											';	
											

												
											}
											}
										?>
										
										<input type="number" name="tscore" class="form-control" placeholder="Enter score" min="1" max="100" step="1" required>
										<input type="hidden" name="tid" value="<?php echo "$task_id"; ?>"> 
										<input type="hidden" name="aid" value="<?php echo "$assess_id"; ?>"> 
								<br><center><input onclick="return confirm('Are you sure you want to submit your task ?')" class="btn btn-success" name= "submit" type="submit" placeholder="Review Task">							
									</center>		
                                   </div>
								   
										</form>
									</div>
                                </div>
                            </div>
                        </div>
						
                    </div>

                </div>
                
            </div>
        </main>

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
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/jquery-counterup/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/toastr/toastr.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../assets/plugins/metrojs/MetroJs.min.js"></script>
        <script src="../assets/js/modern.js"></script>

		<script src="../assets/js/canvasjs.min.js"></script>
		 

        
    </body>


</html>