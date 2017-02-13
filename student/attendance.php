<?php require('../helper/dbHelper.php'); ?>
<?php require('../component/head.php'); ?>
<?php $result = getAttendance($conn,$_SESSION['id']); ?>

<!DOCTYPE HTML>
<html>
	<body>
		
	<div class="fh5co-loader"></div>

    <?php require("../component/login_topnav.php"); ?>

	<div class="container padd-container">
  		<div class="row">
			  <div class="col-xs-12 col-md-3">
				<?php 
				  $student_sidebar = "attendance";
				  require('../component/student_sidebar.php');
				?>
			  </div>
			  <div class="col-xs-12 col-md-9">
                <div class="well well-lg shadow">
                <h2>Your Attendance</h2><br>
                    <table class="table table-bordered">
                    <tr>
                        <th>Period</th>
                        <th>Total</th>
                        <th>Attended</th>
                        <th>Percentage</th>
                    </tr>
                    <?php
                    if($result)
                    {
                        while($row = $result->fetch_assoc())
                        {
                            extract($row);
                            echo "<tr class=\"cursor-hand\">".
                                    "<td>$duration</td>".
                                    "<td>$total</td>". 
                                    "<td>$attended</td>".
                                    "<td>".(($attended/$total)*100)."%</td>".
                                    "</tr>";
                        }
                    }
                    ?>
                    <tr>
                        <td colspan="4" align="center">
                        <strong>Average Attendance : <?php echo getAvgAttendance($conn,$_SESSION['id']) ?>%</strong>
                        </td>
                    </tr>
                    </table>
                </div>
			  </div>
		</div>
	</div>
	
    

    <?php require('../component/footer.php'); ?>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('../component/scripts.php'); ?>

    </body>
</html>