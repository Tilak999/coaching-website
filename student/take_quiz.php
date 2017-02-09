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

<!DOCTYPE HTML>
<html>
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
                <div class="panel panel-default shadow">
                    <div class="panel-body" style="padding:20px;">
                        <h3>Description: </h3>
                        <p><?php echo $quiz["description"]; ?></p>

                        <h3>Guidelines: </h3>
                        <p><?php echo $quiz["guidelines"]; ?></p>
                  </div>
                </div>
              </div>

			  <div class="col-xs-12 col-md-8 well">
                <h3><?php echo $quiz["title"]; ?></h3>
                <form action="eval_quiz.php" method="POST">
                <input type="text" class="hidden" name="quiz-id" value="<?php echo $quiz["id"]; ?>"/>
                <?php
                    if($result!=null && $quiz!=null)
                    {
                        $count = 1;

                        while($row = $result->fetch_assoc())
                        {
                            echo '<div class="panel panel-primary shadow">
                                    <div class="panel-heading">
                                        <h2 class="panel-title">Q'.$count.'. '.$row['question'].'</h2>
                                    </div>
                                    <div class="panel-body">
                                        <input type="radio" name="'.$row['id'].'" value="1">&nbsp;A) '.$row['option1'].'<br>
                                        <input type="radio" name="'.$row['id'].'" value="2">&nbsp;B)  '.$row['option2'].'<br>
                                        <input type="radio" name="'.$row['id'].'" value="3">&nbsp;C)  '.$row['option3'].'<br>
                                        <input type="radio" name="'.$row['id'].'" value="4">&nbsp;D)  '.$row['option4'].'<br>
                                        <input class="hidden" type="radio" name="'.$row['id'].'" value="0" checked>
                                    <button type="button" class="btn btn-default pull-right" onClick="clearSelection(this)">Clear</button>
                                    </div>
                                </div>';
                            
                            $count = $count +1;
                        }

                    }
                ?>
                </form>
			  </div>
		</div>
	</div>

    <!-- Model Shown Before The Test Starts -->
    <div class="modal fade" id="test-model" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Description and Guidelines</h4>
            </div>
            <div class="modal-body">
                <h3>Description: </h3>
                <p><?php echo $quiz["description"]; ?></p>

                <h3>Guidelines: </h3>
                <p><?php echo $quiz["guidelines"]; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Ready</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Model Shown Before Submission of test -->
    <div class="modal fade" id="submit-test-model" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Submit Test</h4>
            </div>
            <div class="modal-body">
                <h4>Do you want to submit the test ?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="end()">Submit</button>
            </div>
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

            

            $("#test-model").modal({keyboard: false,backdrop: 'static'});
            $("#test-model").find("button").click(function(){
                myTimer.start(<?php echo $quiz["time_alloted"]; ?>);
                $("#test-model").modal('hide')
            });
           
		});

        function tick(ms)
        {
            $("#clock").html(msToTime(ms));
        }

        function end()
        {
            $("form").submit();
        }

        function submit(confirm)
        {
            $("#submit-test-model").modal();
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