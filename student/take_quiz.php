<!DOCTYPE HTML>
<html>
	<?php require('../helper/dbHelper.php'); ?>
	<?php require('../component/head.php'); ?>
	<?php 
        
        if(isset($_GET['id']))
        {
            $result = getQuestions($conn,$_GET['id']);
            $quiz = getQuizData($conn,$_GET['id']);
        }
        else
        {
            header("Location:".$base_url);
            die();
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
                  <h3>Description: </h3>
                  <p><?php echo $quiz["description"]; ?></p>

                  <h3>Guidelines: </h3>
                  <p><?php echo $quiz["guidelines"]; ?></p>
              </div>

			  <div class="col-xs-12 col-md-8">
                <h3><?php echo $quiz["title"]; ?></h3>
                <form action="eval_quiz.php" method="POST">
                <input type="text" class="hidden" name="quiz-id" value="<?php echo $quiz["id"]; ?>"/>
                <?php
                    if($result!=null && $quiz!=null)
                    {
                        $count = 1;

                        while($row = $result->fetch_assoc())
                        {
                            echo '<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Q'.$count.'. '.$row['question'].'</h3>
                                    </div>
                                    <div class="panel-body">
                                        <input type="radio" name="'.$row['id'].'" value="1"> '.$row['option1'].'<br>
                                        <input type="radio" name="'.$row['id'].'" value="2"> '.$row['option2'].'<br>
                                        <input type="radio" name="'.$row['id'].'" value="3"> '.$row['option3'].'<br>
                                        <input type="radio" name="'.$row['id'].'" value="4"> '.$row['option4'].'<br>
                                    </div>
                                    <input class="hidden" type="radio" name="'.$row['id'].'" value="0" checked>
                                    <button type="button" class="quiz-clear-btn" onClick="clearSelection(this)">Clear</button>
                                </div>';
                            
                            $count = $count +1;
                        }

                    }
                ?>
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

		$(document).ready(function(){

            var myTimer = new Timer({
                tick    : 1,
                ontick  : tick,
                onend   : end 
            });

            var start = confirm("Ready for Quiz.\n Look for time in top right..");

            if(start == true)
            {
                myTimer.start(<?php echo $quiz["time_alloted"]; ?>);
            }
            else
            {
                window.close();
            }
		});

        function tick(ms)
        {
            $("#clock").html(msToTime(ms));
        }

        function end()
        {
            $("form").submit();
        }

        function submit()
        {
            var ans = confirm("Do you want to Submit Quiz ?");

            if(ans == true)
            {
                end();
            }
        }

        function msToTime(duration) {
            var seconds = parseInt((duration/1000)%60)
                , minutes = parseInt((duration/(1000*60))%60)
                , hours = parseInt((duration/(1000*60*60))%24);

            hours = (hours < 10) ? "0" + hours : hours;
            minutes = (minutes < 10) ? "0" + minutes : minutes;
            seconds = (seconds < 10) ? "0" + seconds : seconds;

            return hours + ":" + minutes + ":" + seconds;
        }

        function clearSelection(v){
           $(v).siblings(".hidden").prop("checked",true);
        }

	</script>

    </body>
</html>