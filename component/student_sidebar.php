<?php if(!isset($_SESSION["valid"])) header("Location:".$base_url); ?>
<?php 
    $ROW = getProfile($conn,$_SESSION['id']);
?>

<div class="row">
  <div class="col-xs-5 col-md-5">
    <a href="#" class="thumbnail">
      <img src="<?php echo $base_url."uploads/".$ROW['image']?>">
    </a>
  </div>
  <div class="col-xs-7 col-md-7" style="padding-left:0px">
    <h4 style="line-height:20px; padding-top:5px"><?php echo $ROW['name'] ?></h4>
    <a href="dashboard.php">Edit Profile</a>
  </div>
</div>
<br>
<ul class="nav nav-pills nav-stacked">
    <li <?php if($student_sidebar == "dashboard") echo "class=\"active\"" ?>><a href="dashboard.php">Profile</a></li>
    <li <?php if($student_sidebar == "change password") echo "class=\"active\"" ?>><a href="change_password.php">Change Password</a></li>
    <li <?php if($student_sidebar == "quiz") echo "class=\"active\"" ?>><a href="quiz.php">Quiz</a></li>
    <li <?php if($student_sidebar == "attendance") echo "class=\"active\"" ?>><a href="attendance.php">Attendence</a></li>
</ul>