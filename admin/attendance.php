<?php require('../helper/dbHelper.php');?>
<?php require('../component/head.php'); ?>
<?php
    if(!isset($_SESSION['admin_id']))
    {
        session_destroy();
        header("Location:".$base_url);
    }

    if(isset($_GET['selector']) && isset($_GET['search']))
    {
        $selector = mysqli_real_escape_string($conn,$_GET['selector']);
        $search = mysqli_real_escape_string($conn,$_GET['search']);

        $result = getStudents($conn,$selector,$search);
    }
    else
    {
        $selector = "Name";
        $search = ""; 
        $result = getStudents($conn,"","");
    }
?>

<!DOCTYPE HTML>
<html>
	<body>
		
	<div class="fh5co-loader"></div>

	<nav class="fh5co-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-2">
                        <div id="fh5co-logo"><a href="/index.php">Law<span>.</span></a></div>
                    </div>
                    <div class="col-xs-10 text-right menu-1">
                        <ul>
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
					<li><a href="dashboard.php">Home</a></li>
					<li><a href="quiz.php">Quiz</a></li>
					<li><a href="student.php">Student</a></li>
					<li class="active"><a href="attendance.php">Attendence</a></li>
                    <li><a href="settings.php">Settings</a></li>
				</ul>
			  </div>
			  <div class="col-xs-12 col-md-9">
                    <div class="well well-lg shadow">
                    
                    <form method="GET">
                        <div class="row">
                            <div class="col-xs-4 col-md-4">
                            <select name="selector" class="form-control">
                                <option>Name</option>
                                <option>Class</option>
                                <option>Email</option>
                                <option>Mobile</option>
                                <option>Registered on</option>
                            </select>
                            </div>
                            <div class="col-xs-8 col-md-8">
                            <div class="input-group">
                                <input style="height:40px" type="text" name="search" class="form-control" placeholder="Search for..." value="<?php echo $search ?>">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default" type="button">Search</button>
                                </span>
                            </div>
                            </div>
                        </div>
                    </form>

                        <br>
                        <!-- tables goes here -->

                        <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Class</th> 
                            <th>Registered On</th>
                        </tr>
                        <?php
                        if($result)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                extract($row);
                                echo "<tr class=\"cursor-hand\" onclick=\"edit($id)\">".
                                        "<td>$name</td>".
                                        "<td>$class</td>". 
                                        "<td>".getAvgAttendance($conn,$id)."% </td>".
                                        "<td>$registered_on</td>".
                                        "<td align=\"center\" onclick=><span class=\"glyphicon glyphicon-pencil\"></span></td>".
                                     "</tr>";
                            }
                        }
                        ?>
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

    <script>

        function edit(id)
        {
            var popup = window.open("editAttendance.php?id="+id,"_blank","top=500, left=500, width=600, height=700");
            popup.moveTo(350,150);
        }

    </script>

    </body>
</html>