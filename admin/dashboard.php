<!DOCTYPE HTML>
<html>
	<?php require('../helper/dbHelper.php');?>
	<?php require('../component/head.php'); ?>
	<?php
		if(!isset($_SESSION['admin_id']))
        {
            session_destroy();
            header("Location:".$base_url);
        }
	?>

	<body>
		
	<div class="fh5co-loader"></div>

	<nav class="fh5co-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-2">
                        <div id="fh5co-logo"><a href="/index.php">Law<span>.</span></a></div>
                    </div>
                    <div class="col-xs-10 text-right menu-1">
                        <ul>
                            <li class="btn-cta"><a href="#"><span>Logout</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

	<div class="container padd-container">
  		<div class="row">
			  <div class="col-xs-12 col-md-3">
				<ul class="nav nav-pills nav-stacked">
					<li class="active"><a href="dashboard.php">Home</a></li>
					<li><a href="quiz.php">Quiz</a></li>
					<li><a href="student.php">Student</a></li>
					<li><a href="attendance.php">Attendence</a></li>
                    <li><a href="settings.php">Settings</a></li>
				</ul>
			  </div>
			  <div class="col-xs-12 col-md-9">
                    <div class="well well-lg shadow">
                        <h2>Welcome Admin !!</h2>
                        <p>From here you can manage all the students and add/modify quiz.</p> 
                    </div>
			  </div>
		</div>
	</div>
	
    

    <?php require('../component/footer.php'); ?>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('../component/scripts.php'); ?>

    </body>
</html>