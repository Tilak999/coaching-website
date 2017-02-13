<?php 

	require('../helper/mailHelper.php'); 
	require('../helper/config.php'); 

	$status = 0;
	$conn = new mysqli($MySql_server, $MySql_user, $MySql_pass, $MySql_db);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

	if(isset($_GET['email']))
	{
		$email = mysqli_real_escape_string($conn,$_GET['email']);
		$status = 1;
		
		$sql = "SELECT * FROM registration_data WHERE email='$email'";
        $result = $conn->query($sql);

        if($result->num_rows == 1)
        {
           	$row = $result->fetch_assoc();
           	
			if(sendRecoveryMail($row['email'],$row['password']))
			{
				$status = 2;
			}
        }
        else
        {
			$status = 3;
        }
	} 
?>

<!DOCTYPE HTML>
<html>
	
	<?php include ('../component/head.php'); ?>
	
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<?php require("../component/nav.php"); ?>

	<div class="grey-div">
		<div class="well well-lg login-box">
			<center>
			<br><h2 class="color-grey">Forgot Password ?</h2>
			<form method="get">
				<?php 

				if($status>0)
				{
					echo "<div class=\"alert alert-warning\">";
					if($status == 2)
					{
						echo "Recovery Mail has been sent to you.<br>It may take 5-10 min.";
					}
					else
					{
						echo "No account with this E-mail. Signup to create account.";
					}
					echo "</div>";
				}
				
				?>
				<div class="form-group" style="padding:20px">
					<p>Enter your registered E-mail to recover your password.</p>
					<input type="email" class="form-control" name="email" placeholder="Email">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</form>
			</center>
		</div>
	</div>

	<?php include('../component/footer.php'); ?>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('../component/scripts.php'); ?>

	</body>
</html>

