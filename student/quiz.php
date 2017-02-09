<?php require('../helper/dbHelper.php'); ?>
<?php require('../component/head.php'); ?>
<?php $result = getQuizList($conn); ?>

<!DOCTYPE HTML>
<html>
	<body>
		
	<div class="fh5co-loader"></div>

    <?php require("../component/login_topnav.php"); ?>

	<div class="container padd-container">
  		<div class="row">
			  <div class="col-xs-12 col-md-3">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="dashboard.php">Profile</a></li>
					<li><a href="change_password.php">Change Password</a></li>
					<li class="active"><a href="quiz.php">Quiz</a></li>
					<li><a href="#">Attendence</a></li>
				</ul>
			  </div>
			  <div class="col-xs-12 col-md-9">
                <div class="list-group">
                <center><h3>Take Quiz</h3></center>
                <?php

                    if($result !=null)
                    {
                        while($row = $result->fetch_assoc())
                        {
                            echo '<a href="take_quiz.php?id='.$row['id'].'"target="_blank" class="list-group-item">'.
                                 '<i class="icon-pencil"></i> '.$row['title'].
                                 '<span class="badge">Author: '.$row['author'].'</span></a>';
                        }

                    }
                    else
                    {
                        echo '<div class="well login-box"><center>Currently no Quiz are available.<br>Check back later.</center></div>';
                    }

                ?>
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