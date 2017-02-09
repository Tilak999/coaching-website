<?php require('../helper/dbHelper.php');?>
<?php require('../component/head.php'); ?>
<?php 
    if(!isset($_SESSION['admin_id']))
    {
        session_destroy();
        header("Location:".$base_url);
    }

    if(isset($_POST['quiz_id']))
    {
        deleteQuiz($conn,$_POST['quiz_id']);
    }
    
    $result = getQuizList($conn); 
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
                            <li class="btn-cta"><a href="#"><span>Logout</span></a></li>
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
					<li class="active"><a href="quiz.php">Quiz</a></li>
					<li><a href="student.php">Student</a></li>
					<li><a href="attendance.php">Attendence</a></li>
                    <li><a href="settings.php">Settings</a></li>
				</ul>
			  </div>
			  <div class="col-xs-12 col-md-9">
                    <div class="well well-lg shadow">
                        <h3>Quiz</h3>
                        <ul class="list-group quiz-list">
                            <?php 

                                if($result != NULL)
                                {
                                    while($row = $result->fetch_assoc())
                                    {
                                        echo '<li class="list-group-item">'.
                                                $row['title']
                                                .'<span class="pull-right" data-id="'.$row['id'].'" >
                                                    <button class="btn btn-default editBtn"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
                                                    <button class="btn btn-default deleteBtn"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                                                </span>
                                            </li>';
                                    }
                                }
                            ?>
                            <li class="list-group-item">
                                <a href="quiz_creator.php">
                                <center>
                                    <span class="glyphicon glyphicon-plus"></span> Create New Quiz
                                </center>
                                </a>
                            </li>
                        </ul>
                        <form method="POST" class="hidden"><input type="text" name="quiz_id" value=0></form>
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

        $(".editBtn").click(function(){
            var id = $(this).parent().attr("data-id");
            window.location = "quiz_creator.php?quiz_id="+id;
        });

        $(".deleteBtn").click(function(){
            var id = $(this).parent().attr("data-id");
            var ans = confirm("You want to delete this Quiz.\nAre you sure ?");

            if(ans == true)
            {
                $("input").val(id);
                $("form").submit(); 
            }
        });

    });

    
    </script>

    </body>
</html>