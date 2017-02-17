<?php require('../helper/dbHelper.php'); ?>
<?php require('../helper/helper.php'); ?>
<?php require('../component/head.php'); ?>

<!DOCTYPE HTML>
<html>
	<body>
		
	<div class="fh5co-loader"></div>

    <?php require("../component/login_topnav.php"); ?>

	<div class="container padd-container">
  		<div class="well well-lg shadow" style="text-align:center; width:100%; max-width:800px; margin:auto; padding:40px;">
            <img src="../images/fail.png" width="150px">
            <br><br>
            <h1 class="text-danger">Payment failed !!</h1>
            <p>Payment failed due to technical error please try again..</p>
            <a class="btn btn-lg btn-default" href="quiz.php">Try Again</a>
        </div>
	</div>
	
    

    <?php require('../component/footer.php'); ?>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('../component/scripts.php'); ?>
    
    </body>
</html>