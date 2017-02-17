<?php require("./helper/mailHelper.php"); ?>
<?php 

	$str="";
	if(!isset($_POST['fname'])) $str = $str."First name required <br>";
	if(!isset($_POST['email'])) $str = $str."E-mail required <br>";
	if(!isset($_POST['subject'])) $str = $str."Subject required <br>";
	if(!isset($_POST['message'])) $str = $str."Message required";

	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
	{
		//your site secret key
        $secret = '6LeH8xUUAAAAAGZ3Ts68dXPkjLU6hy38GFjLEK6R';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);

        if($responseData->success)
		{
			if($str=="" && !empty($_POST['email']))
			{
				$str = "Your message successfully saved. <br> We will contact you soon.";
				sendQueryMail($_POST);
			}
		}
	}

?>

<!DOCTYPE HTML>
<html>

	<?php require('./component/head.php'); ?>

	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	
	<?php require("./component/nav.php"); ?>

	<div id="fh5co-contact">
		<div class="container well well-lg shadow">
            <br><br>
			<div class="row">
				<div class="col-md-5 col-md-push-1 animate-box">
					
					<div class="fh5co-contact-info">
						<h3>Contact Information</h3>
						<ul>
							<li class="address">
								<h3>H.O. ADDRESS</h3>
								<p>460 ASHWATH NAGAR<br>THANISANDRA MAIN ROAD<br> BANGALORE-560077</p>

								<h3>BRANCH ADDRESS</h3>
								<b>PATNA</b><br>
								3D POPULAR PALACE</br>
								BARIPATH</br>
								LANGARTOLI</br>
								PATNA-800004</br>

								<b>RANCHI</b><br>
								43 ITO GOLAMBAR</br>
								DHURVA RANCHI</br>
								JHARKHAND-834001</br>

								<b>INDORE</b><br>
								FERN BLOCK<br>
								SHALIMAR TOWNSHIP<br>
								AB ROAD<br>
								INDORE-452010<br>

								<b>DELHI</b><br>
								N-57<br>
								SRINIWASPURI<br>
								NEW DELHI-110065<br>
							</li>
							<li class="phone"><a href="tel://1234567920">+ 1235 2355 98</a></li>
							<li class="email"><a href="mailto:info@wavecarrierinstitute.com">info@wavecarrierinstitute.com</a></li>
							<li class="url"><a href="http://wavecarrierinstitute.com">www.wavecarrierinstitute.com</a></li>
						</ul>
					</div>

				</div>
				<div class="col-md-6 animate-box">
                    <div class="alert alert-warning">
                        <?php echo $str; ?>
                    </div>
					<h3>Send A Message</h3>
					<form action="/submitQuery.php" method="POST">
						<div class="row form-group">
							<div class="col-md-6">
								<!-- <label for="fname">First Name</label> -->
								<input type="text" name="fname" class="form-control" placeholder="Your firstname">
							</div>
							<div class="col-md-6">
								<!-- <label for="lname">Last Name</label> -->
								<input type="text" name="lname" class="form-control" placeholder="Your lastname">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="email">Email</label> -->
								<input type="text" name="email" class="form-control" placeholder="Your email address">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="subject">Subject</label> -->
								<input type="text" name="subject" class="form-control" placeholder="Your subject of this message">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="message">Message</label> -->
								<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Say something about us"></textarea>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<div class="g-recaptcha" data-sitekey="6LeH8xUUAAAAAMhNdsrkBxlrtN-jxxstHdPUJwti"></div>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Send Message" class="btn btn-primary">
						</div>
					</form>		
				</div>
			</div>
		</div>
	</div>
	<div id="map" class="fh5co-map"></div>

	<?php require('./component/footer.php'); ?>
	
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('./component/scripts.php'); ?>
	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>

	</body>
</html>

