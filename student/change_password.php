<?php require('../helper/dbHelper.php'); ?>
<?php

    if(isset($_POST['old']) && isset($_POST['new']))
    {
        $old = md5(mysqli_real_escape_string($conn,$_POST['old']));
        $new = md5(mysqli_real_escape_string($conn,$_POST['new']));

        $sql = "UPDATE registration_data SET password = '$new' WHERE id = ".$_SESSION['id']." AND password = '$old'";
        
        if($conn->query($sql)==TRUE)
        {
            echo "success";
        }
        die();
    }
?>


<!DOCTYPE HTML>
<html>
    <?php require('../component/head.php'); ?>
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
							<li class="btn-cta"><a href="/logout.php"><span>Logout</span></a></li>
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
					<li><a href="dashboard.php">Profile</a></li>
					<li class="active"><a href="changepassword.php">Change Password</a></li>
					<li><a href="#">Quiz</a></li>
					<li><a href="#">Attendence</a></li>
				</ul>
			  </div>
			  <div class="col-xs-12 col-md-9">
              <div class="alert alert-warning hidden">
                <center>Password should be atleast 6 charecters long.</center>
              </div>
			  <div class="form-group">
					<label>Current Password</label>
					<input id="old" type="password" class="form-control">
				</div>
				<div class="form-group">
					<label>New Password</label>
					<input id="new" type="password" class="form-control" placeholder="new password">
				</div>
                <div class="form-group">
					<label>Re-type Password</label>
					<input id="re" type="password" class="form-control" placeholder="Re-type password">
				</div>
				<br>
				<button id="change"type="button" class="btn btn-primary">Change</button>
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
			
            $("#change").click(function(){

                var old_pass = $("#old").val();
                var new_pass = $("#new").val();
                var re = $("#re").val();

                if(new_pass == re && new_pass.length > 6)
                {
                    $.post("/student/change_password.php",
                    {
                        old: old_pass,
                        new: new_pass
                    },
                    function(data, status){
                    
                        if(data=="success")
                        {
                            alert("Password updated");
                            location.reload();
                        }
                        else
                        {
                            alert(data);
                        }
				    });
                }
                else
                {
                    $(".alert").removeClass("hidden");
                }

            });

		});

	</script>

    </body>
</html>