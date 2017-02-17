<?php require('../helper/dbHelper.php'); ?>
<?php require('../helper/helper.php'); ?>
<?php require('../component/head.php'); ?>
<?php

    if(!isset($_GET['id'])) header("Location:".$base_url);

    $quiz = getQuizData($conn,$_GET['id']);
    $_SESSION['quiz_id'] = $_GET['id'];
    $_SESSION['random_hash'] = generateRandomString();

?>

<!DOCTYPE HTML>
<html>
	<body>
		
	<div class="fh5co-loader"></div>

    <?php require("../component/login_topnav.php"); ?>

	<div class="container padd-container">
  		<div class="well well-lg shadow" style="text-align:center; width:100%; max-width:800px; margin:auto; padding:40px;">
            <h1><?php echo $quiz['title'] ?></h1>
            <p><?php echo $quiz['description'] ?></p>
            <h3>Fees payable: Rs. 1500</h3>
            <br>
            <a href="https://www.payumoney.com/paybypayumoney/#/0E887217B1B0AA5DB7B8C1BFA590EAA7"><img src="../images/paynow.png"></a>
            <br>
        </div>
	</div>
	
    

    <?php require('../component/footer.php'); ?>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('../component/scripts.php'); ?>

    </body>
</html>