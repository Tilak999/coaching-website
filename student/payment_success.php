<?php require('../helper/dbHelper.php'); ?>
<?php require('../helper/helper.php'); ?>
<?php require('../component/head.php'); ?>
<?php
    
    if(isset($_SESSION['random_hash']) && isset($_SESSION['quiz_id']) && isset($_GET['token'])) 
    {
        $_SESSION['token'] = $_GET['token'];
        $hash = md5($_SESSION['random_hash'].$_SESSION['quiz_id'].$_SESSION['token']);
        $url = $base_url."student/take_quiz.php?uid=".$hash;
    }
    else
    {
         header("Location:".$base_url);
    }

?>

<!DOCTYPE HTML>
<html>
	<body>
		
	<div class="fh5co-loader"></div>

    <?php require("../component/login_topnav.php"); ?>

	<div class="container padd-container">
  		<div class="well well-lg shadow" style="text-align:center; width:100%; max-width:800px; margin:auto; padding:40px;">
            <img src="../images/success.svg" width="150px">
            <br><br>
            <h1 class="text-success">Payment Successful</h1>
            <p>Please wait, while we redirect you to quiz.</p>
        </div>
	</div>
	
    

    <?php require('../component/footer.php'); ?>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('../component/scripts.php'); ?>

    <script>

        $(document).ready(function(){
            setTimeout(redirect,3000);
        });

        function redirect()
        {
            window.location.href = "<?php echo $url ?>";
            console.log("<?php echo $url ?>")
        }
        
    </script>
    
    </body>
</html>