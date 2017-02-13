<?php 
	require('../helper/dbHelper.php'); 

	if(!isset($_SESSION['id']))
	{
		session_destroy();
		header("Location:".$base_url);
		die();
	}
	
	$arr = getProfile($conn,$_SESSION['id']); 
?>

<!DOCTYPE HTML>
<html>
	<?php require('../component/head.php'); ?>
	<body>
		
	<div class="fh5co-loader"></div>

	<?php require("../component/login_topnav.php"); ?>

	<div class="container padd-container">
  		<div class="row">
			  <div class="col-xs-12 col-md-3">
			  	<?php 
				  $student_sidebar = "dashboard";
				  require('../component/student_sidebar.php');
				?>
			  </div>
			  <div class="col-xs-12 col-md-9">
			  	<div class="well well-lg shadow">
				<form method="POST" action="/student/update_profile.php" enctype="multipart/form-data">
				  	<div class="form-group">
					   	<div class="row">
							<div class="col-xs-12 col-md-3">
								<a href="#" class="thumbnail">
								<img src="<?php echo $base_url."uploads/".$arr['image']?>">
								</a>
							</div>
							<div class="col-xs-5 col-md-5">
								<br><br>
								<input type="file" name="photo" accept=".jpg,.jpeg,.png">
								<p class="help-block">Image file size should not be larger than 2MB</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>E-mail</label>
						<input name="email" id="email" type="email" class="form-control" placeholder="Email" value="<?php echo $arr['email']?>">
					</div>
					<div class="form-group">
						<label>Name</label>
						<input name="name" id="name" type="email" class="form-control" placeholder="Name" value="<?php echo $arr['name']?>">
					</div>
					<div class="form-group">
						<label>Class:</label>
						<select name="class" class="form-control" id="class">
							<option>12 Medical</option>
							<option>12 PCM</option>
							<option>11 PCM</option>
							<option>11 Medical</option>
							<option>10th</option>
						</select>
					</div>
					<div class="form-group">
						<label>Mobile:</label>
						<input name="mobile" id="mobile" type="number" class="form-control" placeholder="Mobile" value="<?php echo $arr['mobile']?>">
					</div>
					<br>
					<button id="bSave" type="button" class="btn btn-primary">Save</button>
					<button id="bLoading" type="button" class="btn btn-primary" style="display:none">Saving Please Wait..</button>
					<button id="bCancel"type="button" class="btn btn-default">Cancel</button>
				</form>
				</div>	  
			  </div>
		</div>
	</div>
	
    

    <?php require('../component/footer.php'); ?>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('../component/scripts.php'); ?>

	<script>

		$(document).ready(function(){
			var cls = "<?php echo $arr['class']?>";
			$("select").val(cls);
	
			$("#bSave").click(save_click);
			$("#bCancel").click(cancel_click);
		});

		function save_click()
		{
			var name = $("#name").val();

			$("#bLoading").fadeToggle();
			$("#bSave").hide();

			if(isvalidMail() && isValidMobile() && name.length>2)
			{
				$("form").submit();
			}
		}

		function cancel_click()
		{
			location.reload();
		}

		function isvalidMail() {

			var email = $("#email").val();
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			
			if(re.test(email) && email != "")
			{
				return true;
			}
			$("#invalid_email").removeClass("hidden");
			return false;
		}

		function isValidMobile(){

			var mobile = $("#mobile").val();
			
			if(mobile.length ==10 && mobile !="" && $.isNumeric(mobile))
			{
				return true;
			}
			$("#invalid_mobile").removeClass("hidden");
			return false;
		}


	</script>

    </body>
</html>