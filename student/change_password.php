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

	<?php require("../component/login_topnav.php"); ?>

	<div class="container padd-container">
  		<div class="row">
			  <div class="col-xs-12 col-md-3">
				<?php 
				  $student_sidebar = "change password";
				  require('../component/student_sidebar.php');
				?>
			  </div>
			  <div class="col-xs-12 col-md-9">
              	<div class="well well-lg shadow">
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