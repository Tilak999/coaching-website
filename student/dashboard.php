<!DOCTYPE HTML>
<html>
	<?php require('../helper/dbHelper.php'); ?>
	<?php require('../component/head.php'); ?>
	<?php $arr = getProfile($_SESSION['id'],$conn); ?>

	<body>
		
	<div class="fh5co-loader"></div>

	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.html">Law<span>.</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="practice.html">Student</a></li>
							<li><a href="won.html">Update </a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="contact.html">Contact</a></li>
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
					<li class="active"><a href="dashboard.php">Profile</a></li>
					<li><a href="change_password.php">Change Password</a></li>
					<li><a href="#">Quiz</a></li>
					<li><a href="#">Attendence</a></li>
				</ul>
			  </div>
			  <div class="col-xs-12 col-md-9">
			  <div class="form-group">
					<label>E-mail</label>
					<input id="email" type="email" class="form-control" placeholder="Email" value="<?php echo $arr['email']?>">
				</div>
				<div class="form-group">
					<label>Name</label>
					<input id="name" type="email" class="form-control" placeholder="Name" value="<?php echo $arr['name']?>">
				</div>
				<div class="form-group">
					<label>Class:</label>
					<select class="form-control" id="class">
						<option>12 Medical</option>
						<option>12 PCM</option>
						<option>11 PCM</option>
						<option>11 Medical</option>
						<option>10th</option>
					</select>
				</div>
				<div class="form-group">
					<label>Mobile:</label>
					<input id="mobile" type="text" class="form-control" placeholder="Mobile" value="<?php echo $arr['mobile']?>">
				</div>
				<br>
				<button id="bSave"type="button" class="btn btn-primary">Save</button>
				<button id="bCancel"type="button" class="btn btn-default">Cancel</button>
						  
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

			if(isvalidMail() && isValidMobile() && name.length>2)
			{
				$.post("/student/update_profile.php",
				{
					email: $("#email").val(),
					name: name,
					class: $("select").val(),
					mobile: $("#mobile").val()
				},
				function(data, status){
				
					if(data=="success")
					{
						alert("Profile updated");
					}
					else
					{
						alert(data);
					}
				});
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