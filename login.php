<!DOCTYPE HTML>
<html>
	
	<?php include ('./component/head.php'); ?>
	
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<?php require("./component/nav.php") ?>

	<div class="golden-div">
		<div class="well well-lg login-box">
			<center><h2 class="color-grey">Login</h2></center>
			<form class="form-horizontal">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
					<input id="email" type="email" class="form-control" name="email" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
					<input id="password" type="password" class="form-control" name="password" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
						<input type="checkbox"> Remember me
						</label>
						<div class="pull-right text-primary">
							<a href="/student/forgot_password.php">Forgot Password ?</a>
						</div>
					</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Sign in</button>
					</div>
				</div>
				<div class="alert alert-warning hidden">
					<center>
					Invalid Email or Password !!<br>
					Please try again.
					</center>
				</div>
			</form>
		</div>
	</div>

	<?php include('./component/footer.php'); ?>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('./component/scripts.php'); ?>
	
	<script>
		$( "form" ).submit(function(event) {
			event.preventDefault();

			var email = $("#email").val();
			var password = $("#password").val();

			if(email !="" && password!="")
			{
				$.post("student/verify.php",
				{
					email: $("#email").val(),
					password: $("#password").val()
				},
				function(data, status){
					console.log(data);
					if(data=="success")
					{
						window.location = "student/dashboard.php";
					}
					else
					{
						alert(data);
					}
				});	
			}
			else
			{
				$("#email").focus();
			}
		});
			
	</script>
	
	</body>
</html>

