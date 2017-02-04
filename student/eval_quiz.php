<!DOCTYPE HTML>
<html>
	<?php require('../helper/dbHelper.php'); ?>
	<?php require('../component/head.php'); ?>
	<?php 
        
        if(isset($_POST)&&isset($_POST["quiz-id"]))
        {
            $result = getQuestions($conn,$_POST["quiz-id"]);
            $quiz = getQuizData($conn,$_POST["quiz-id"]);

            if($result!=NULL)
            {
                $data["marks"] = 0;
                $data["count"] = $result->num_rows;
                $data["attempted"] = 0;
                $data["correct"] = 0;
                $data["quiz-id"] = $_POST["quiz-id"];

                while($row = $result->fetch_assoc())
                {
                    $id = $row["id"];
                    $answer = $row["answer"];
                    
                    if($_POST[$id]==$answer)
                    {
                        $data["marks"] = $data["marks"] + $row["marks"];
                        $data["attempted"]++;
                        $data["correct"]++;
                    }
                    else if($_POST[$id]==0)
                    {
                        // do nothing if user not given answer
                    }
                    else
                    {
                        $data["marks"] = $data["marks"] + $row["negative_marks"];
                        $data["attempted"]++;
                    }
                }

                saveQuizReport($conn,$data);

            }
            else
            {
                header("Location:".$base_url."student/dashboard.php");
            }
        }
    ?>

	<body>
		
	<div class="fh5co-loader"></div>

	<?php require("../component/login_topnav.php"); ?>

	<div class="container padd-container">
        <br>
  		<div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="well shadow">
                    <br>
                <center>
                    <h2><?php echo $quiz["title"]; ?></h2>
                    <h2 class="color-grey">Your Score</h2>
                    <h1>
                        <?php echo $data["marks"]; ?>
                        <span class="color-grey">/
                            <?php echo $quiz["max_marks"]; ?>
                        </span>
                    </h1>
                    <br>
                    <p>Number of Question Attempted: <?php echo $data["attempted"]; ?><br>
                        Number of correct Answer: <?php echo $data["correct"]; ?>
                    </p>
                </center>
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

		

	</script>

    </body>
</html>