<?php 

	require('../helper/config.php'); 

	$conn = new mysqli($MySql_server, $MySql_user, $MySql_pass, $MySql_db);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $status = 0;
	if(isset($_GET['email']) && isset($_GET['id']))
	{
		$email = mysqli_real_escape_string($conn,$_GET['email']);
        $pass = mysqli_real_escape_string($conn,$_GET['id']);

        if(isset($_POST['pass1']) && isset($_POST['pass2']))
        {
            if($_POST['pass1']==$_POST['pass2'])
            {
                $new_pass = md5(mysqli_real_escape_string($conn,$_POST['pass1']));
                $sql = "UPDATE registration_data SET password = '".$new_pass."' WHERE email='$email' AND password='$pass'";
        
                if($conn->query($sql) == TRUE && $conn->affected_rows == 1)
                {
                    $status = 1;
                }
            }
            else
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
			<br><h2 class="color-grey">Reset Password</h2>
			<form method="post">
				<?php 

				if($status>0)
				{
					if($status == 1)
					{
                        echo "<div class=\"alert alert-success\">";
						echo "Password Successfully Changed.";
                        echo "</div>";
					}
					else if($status == 2)
					{
						echo "<div class=\"alert alert-danger\">";
						echo "Password don't match.";
                        echo "</div>";
					}
				}
                else
                {
                    header("Location:".$base_url);
                }
				
				?>
				<div class="form-group" style="padding-top:20px">
					<p>New-Password</p>
					<input type="password" class="form-control" name="pass1" placeholder="New Password">
				</div>
                <div class="form-group">
					<p>Re-enter New-Password</p>
					<input type="password" class="form-control" name="pass2" placeholder="Repeat Password">
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

