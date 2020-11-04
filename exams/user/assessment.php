<?php 
date_default_timezone_set('Africa/Dar_es_salaam');
session_start();

if(isset($_SESSION['id_user'])) { 
  include 'includes/fetch_records.php';
}
else
{
header("Location: ../../index.php");
exit();
}
include 'includes/check_reply.php';
include '../includes/uniques.php';
if (isset($_SESSION['current_examid'])) {
include '../../db.php';
$exam_id = $_SESSION['current_examid'];	

$sql = "SELECT * FROM examinations WHERE exam_id = '$exam_id' AND status = 'Active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $exam_name =$row['exam_name'];
	$duration = $row['duration'];
	$passmark = $row['passmark'];
	$terms = $row['terms'];
	$status = $row['status'];
	$today_date = date('m/d/Y');
    }
} else {
header("location:./");	
}
}else{
header("location:./");	
}



$sql = "SELECT * FROM assessment_records WHERE exam_id = '$exam_id' AND id_user = '$myid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    header("location:./take-assessment.php?id=$exam_id");
    }
} else {
$myname = "$myfname $mylname";
$recid = 'RS'.get_rand_numbers(14).'';

$sql = "INSERT INTO assessment_records (record_id, id_user, exam_id, score, status, date)
VALUES ('$recid', '$myid','$exam_id', '0', 'FAIL', '$today_date')";

if ($conn->query($sql) === TRUE) {

} else {

}
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
/* The container */
.container {
  display: block;
  position: relative;

  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}


/* Create a custom radio button */
.checkmark {
  position: absolute;

}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}
</style>
    </head>
	<body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?> >
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a class="logo-text"><span><div id="quiz-time-left"></div></span></a>
                    </div>

                    <div class="topmenu-outer">
                        <div class="top-menu">
						 <ul class="nav navbar-nav navbar-left">


                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="../../logout.php" class="log-out waves-effect waves-button waves-classic">
                                        <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                                    </a>
                                </li>
                                <li>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        <main class="content-wrap">
            <div class="page-inner">
                <div class="page-title">
                    <h3>Examination</h3>
					<h4>Note: Don't Refresh this page or switch tabs <h5>(Examination will be expired Instantly)</h5></h4>

                </div>
                <div id="main-wrapper">
                    <div class="row">
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <div class="tabs-below" role="tabpanel">
                                       <form action="pages/submit_assessment.php" method="POST" name="quiz" id="quiz_form" >
                                            <div class="tab-content">
											<?php 
											include '../../db.php';
											$sql = "SELECT * FROM questions WHERE exam_id = '$exam_id'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            while($row = $result->fetch_assoc()) {
												$qsid = $row['question_id'];
												$qs = $row['question'];
												$type = $row['type'];
												$op1 = $row['option1'];
												$op2 = $row['option2'];
												$op3 = $row['option3'];
												$op4 = $row['option4'];
												$ans = $row['answer'];
												$enan = $row[$ans];
                                            if ($type == "FB") {
											if ($qno == "1") {
											print '
											<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
                                             <p><b>'.$qno.'.</b> '.$qs.'</p>
											 <p><input type="text" name="an'.$qno.'"  class="form-control" placeholder="Enter your answer" autocomplete="off">
											 <input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
											 <input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
                                             </div>
											';	
											}else{
											print '
											<div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">
                                             <p><b>'.$qno.'.</b> '.$qs.'</p>
											 <p><input type="text" name="an'.$qno.'"  class="form-control" placeholder="Enter your answer" autocomplete="off">
					                         <input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
											 <input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
                                             </div>
											';		
											}

											$qno = $qno + 1;	
											}else{
											
											if ($qno == "1") {

											print '
											<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
                                             <p><b>'.$qno.'.</b> '.$qs.'</p>
											 <p><label class="container"><input type="radio" name="an'.$qno.'"  class="form-control container" value="'.$op1.'"> '.$op1.'</p></label>
											 <p><label class="container"><input type="radio" name="an'.$qno.'"  class="form-control container" value="'.$op2.'"> '.$op2.'</p></label>
											 <p><label class="container"><input type="radio" name="an'.$qno.'"  class="form-control container" value="'.$op3.'"> '.$op3.'</p></label>
											 <p><label class="container"><input type="radio" name="an'.$qno.'"  class="form-control container" value="'.$op4.'"> '.$op4.'</p></label>
											 <input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
											 <input type="hidden" name="ran'.$qno.'" value="'.base64_encode($enan).'">
                                             </div>
											';	
											}else{
											print '
											<div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">
                                             <p><b>'.$qno.'.</b> '.$qs.'</p>
											 <p><label class="container"><input type="radio" name="an'.$qno.'"  class="form-control container" value="'.$op1.'"> '.$op1.'</p></label>
											 <p><label class="container"><input type="radio" name="an'.$qno.'"  class="form-control container" value="'.$op2.'"> '.$op2.'</p></label>
											 <p><label class="container"><input type="radio" name="an'.$qno.'"  class="form-control container" value="'.$op3.'"> '.$op3.'</p></label>
											 <p><label class="container"><input type="radio" name="an'.$qno.'"  class="form-control container" value="'.$op4.'"> '.$op4.'</p></label>
											 <input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
											 <input type="hidden" name="ran'.$qno.'" value="'.base64_encode($enan).'">
                                             </div>
											';		
											}

											$qno = $qno + 1;	

											
											}

                                            }
                                            } else {
 
                                            }
											
											?>

                                            </div>
                 
											
                                            <ul class="nav nav-tabs" role="tablist">
											<?php 
											include '../../db.php';
											$sql = "SELECT * FROM questions WHERE exam_id = '$exam_id'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
											$total_questions = 0;
                                            while($row = $result->fetch_assoc()) {
											$total_questions++;
											if ($qno == "1") {
											print '<li role="presentation" class="active"><a href="#tab'.$qno.'" role="tab" data-toggle="tab">'.$qno.'</a></li>';	
											}else{
											print '<li role="presentation"><a href="#tab'.$qno.'" role="tab" data-toggle="tab">'.$qno.'</a></li>';		
											}

											$qno = $qno + 1;
                                            }
                                            } else {
 
                                            }
											
											?>
                                            <input type="hidden" name="tq" value="<?php echo "$total_questions"; ?>">
											<input type="hidden" name="eid" value="<?php echo "$exam_id"; ?>">
											<input type="hidden" name="pm" value="<?php echo "$passmark"; ?>">
											<input type="hidden" name="ri" value="<?php echo "$recid"; ?>">
											
                                            </ul>
											

                                        </div>
								<br><input onclick="return confirm('Are you sure you want to submit your assessment ?')" class="btn btn-success" type="submit" value="Submit Assessment">
											</form>
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
document.addEventListener("visibilitychange", function() {
      location.reload();
});
</script>

<script type="text/javascript">
var max_time = <?php echo "$duration" ?>;
var c_seconds  = 0;
var total_seconds =60*max_time;
max_time = parseInt(total_seconds/60);
c_seconds = parseInt(total_seconds%60);
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + 'Min';
function init(){
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + ' Min';
setTimeout("CheckTime()",999);
}
function CheckTime(){
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + ' Min' ;
if(total_seconds <=0){
setTimeout('document.quiz.submit()',1);
    
    } else
    {
total_seconds = total_seconds -1;
max_time = parseInt(total_seconds/60);
c_seconds = parseInt(total_seconds%60);
setTimeout("CheckTime()",999);
}

}
init();
</script>
    </body>

</html>


