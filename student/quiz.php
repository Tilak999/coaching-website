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
				<?php 
				  $student_sidebar = "quiz";
				  require('../component/student_sidebar.php');
				?>
			  </div>
			  <div class="col-xs-12 col-md-9">
              	<div class="well well-lg shadow">
                    <div class="list-group">
                    <center><h3>Take Quiz</h3></center>
                    <?php

                        if($result !=null)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                echo '<a href="payment.php?id='.$row['id'].'"target="_blank" class="list-group-item">'.
                                    '<i class="icon-pencil"></i> '.$row['title'].
                                    '<span class="label label-info pull-right">Author: '.$row['author'].'</span></a>';
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
	</div>
	
    

    <?php require('../component/footer.php'); ?>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('../component/scripts.php'); ?>

    </body>
</html>