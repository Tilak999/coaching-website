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
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="practice.html">Practice Areas</a></li>
							<li><a href="won.html">Won Cases</a></li>
							<li class="has-dropdown">
								<a href="blog.html">Blog</a>
								<ul class="dropdown">
									<li><a href="#">Web Design</a></li>
									<li><a href="#">eCommerce</a></li>
									<li><a href="#">Branding</a></li>
									<li><a href="#">API</a></li>
								</ul>
							</li>
							<li><a href="about.html">About</a></li>
							<li><a href="contact.html">Contact</a></li>
							<li class="btn-cta"><a href="#"><span>Sign Up</span></a></li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</nav>

	<div class="grey-div">
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

