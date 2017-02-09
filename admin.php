<!DOCTYPE HTML>
<html>
	
	<?php include ('./component/head.php'); ?>
	
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.html">Coaching<span>.</span></a></div>
					</div>
				</div>
				
			</div>
		</div>
	</nav>

	<div class="grey-div">
		<div class="well well-lg login-box">
			<center><h2 class="color-grey">Admin Login</h2></center>
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
						<div class="pull-right text-primary">
							<a href="#forgot">Forgot Password ?</a>
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
				$.post("admin/verify.php",
				{
					email: $("#email").val(),
					password: $("#password").val()
				},
				function(data, status){
					console.log(data);
					if(data=="success")
					{
						window.location = "admin/dashboard.php";
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

