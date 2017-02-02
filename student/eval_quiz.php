<!DOCTYPE HTML>
<html>
	<?php require('../helper/dbHelper.php'); ?>
	<?php require('../component/head.php'); ?>
	<?php 
        
        if(isset($_POST)&&isset($_POST["quiz-id"]))
        {
            $result = getQuestions($conn,$_POST["quiz-id"]);

            if($result!=NULL)
            {
                $marks = 0;
                $total_qsn = $result->num_rows;
                $attempted = 0;
                $correct = 0;

                while($row = $result->fetch_assoc())
                {
                    $id = $row["id"];
                    $answer = $row["answer"];
                    
                    if($_POST[$id]==$answer)
                    {
                        $marks = $marks + $row["marks"];
                        $attempted++;
                        $correct++;
                    }
                    else if($_POST[$id]==0)
                    {
                        // do nothing if user not given answer
                    }
                    else
                    {
                        $marks = $marks + $row["negative_marks"];
                        $attempted++;
                    }
                }

                echo $marks;
            }
        }
    ?>

	<body>
		
	<div class="fh5co-loader"></div>

	<nav class="fh5co-nav navbar-fixed-top shadow" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-2">
                        <div id="fh5co-logo"><a href="/index.php">Law<span>.</span></a></div>
                    </div>
                    <div class="col-xs-10 text-right menu-1">
                        <button class="btn btn-default" id="clock">00:00:00</button>
                        <button class="btn btn-primary" onclick="submit()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

	<div class="container padd-container">
        <br><br><br>
  		<div class="row">
              <div class="col-xs-12 col-md-4">
                 
              </div>

			  <div class="col-xs-12 col-md-8">
                <form action="eval_quiz.php" method="POST">
           
                
                </form>
			  </div>
		</div>
	</div>
	
    

    <?php require('../component/footer.php'); ?>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<?php require('../component/scripts.php'); ?>

    <script src="<?php echo $base_url; ?>js/timer.min.js"></script>

	<script>

		

	</script>

    </body>
</html>