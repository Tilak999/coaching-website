<?php
	session_start();
	$_SESSION['hash'] = md5(rand(100,500));
?>

<!DOCTYPE HTML>
<html>
	
	<?php include ('./component/head.php'); ?>

	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<?php require("./component/nav.php") ?>

		<div class="well well-lg shadow login-box">
			<center><h2 class="color-grey">Register</h2></center><br>
			<form class="form-horizontal">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
					<input id="email" type="email" class="form-control" name="email" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
					<input id="name" type="text" class="form-control" name="name" placeholder="Full name">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
					<input id="password" type="password" class="form-control" name="password" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Re-type Password</label>
					<div class="col-sm-10">
					<input id="password_re" type="password" class="form-control" placeholder="Re-type Password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Mobile</label>
					<div class="col-sm-10">
					<input id="mobile" type="tel" class="form-control" placeholder="Mobile Number">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Register</button>
					</div>
				</div>
				<div id="invalid_email" class="alert alert-danger hidden">
					Invalid E-mail.
				</div>
				<div id="password_error" class="alert alert-danger hidden">
					Password don't match<br>or password length is less than 7.
				</div>
				<div id="invalid_mobile" class="alert alert-danger hidden">
					Invalid mobile number.
				</div>
			</form>
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
			$(".alert").addClass("hidden");

			var name = $("#name").val()

			if(isvalidMail() && isValidPassword() && isValidMobile() && name.length>1)
			{
				$.post("/student/register.php",
				{
					email: $("#email").val(),
					name: name,
					password: $("#password").val(),
					mobile: $("#mobile").val(),
					hash: "<?php echo $_SESSION['hash'] ?>"
				},
				function(data, status){
				
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
		});

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

		function isValidPassword(){

			var password = $("#password").val();
			var password_re = $("#password").val();
			
			if(password == password_re && password.length >6)
			{
				return true;
			}
			$("#password_error").removeClass("hidden");
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

