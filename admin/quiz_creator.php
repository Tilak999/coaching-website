<!DOCTYPE HTML>
<html>
	<?php require('../helper/dbHelper.php');?>
	<?php require('../component/head.php'); ?>
	<?php 

        if(isset($_GET['quiz_id']))
        {
            $fill_data = TRUE;
            $result = getQuizData($conn,$_GET['quiz_id']);
            if(!$result) header("Location:".$base_url);
        }
        else
        {
            $fill_data = false;
        }

    ?>

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
				<h4>Quiz Title</h4>
                <textarea id="title" class="quiz-textarea"><?php echo $result['title']; ?></textarea>

                <h4>Description</h4>
                <textarea id="description" class="quiz-textarea" placeholder="(optional)"><?php echo $result['description']; ?></textarea>

                <h4>Guildelines</h4>
                <textarea id="guildelines" class="quiz-textarea" placeholder="(optional)"><?php echo $result['guidelines']; ?></textarea>

			  </div>
			  <div class="col-xs-12 col-md-9">
                    <div class="well well-lg">
                        <div id="question_list">
                        </div>
                        <button id="add_question" class="btn btn-default">Add new Question</button>
                    </div>
                    
                    <div id="question-panel" class="panel panel-default hidden">
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon">Q</span>
                                <input type="text" class="form-control" placeholder="Write question here" value="$qsn">
                            </div>
                            <br>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">1</span>
                                <input type="text" class="form-control" placeholder="Option 1" value="$optn1">
                            </div>
                            
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">2</span>
                                <input type="text" class="form-control" placeholder="Option 2" value="$optn2">
                            </div>

                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">3</span>
                                <input type="text" class="form-control" placeholder="Option 3" value="$optn3">
                            </div>

                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">4</span>
                                <input type="text" class="form-control" placeholder="Option 4" value="$optn4">
                            </div>
                            
                            <br>Answer:
                            <select class="form-control">
                                <option value="1" $ans1>Option 1</option>
                                <option value="2" $ans2>Option 2</option>
                                <option value="3" $ans3>Option 3</option>
                                <option value="4" $ans4>Option 4</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-default qsn-delete-btn" onclick="del(this)">Delete</button>
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

        var v = $("#description").val().replace(/\r\n|\r|\n/g,"<br />");
        
        $("#add_question").click(function(){
            var v = frameQuestion();
            $("#question_list").append(v);
            //console.log(v);
        });

    });

    function del(v)
    {
        $(v).parent().remove();
    }

    function frameQuestion(qsn="",option=[],ans="")
    {
        var str = $("#question-panel").html();
        str = str.replace("$qsn",qsn);

        if(ans!="")
        {
            str = str.replace("$ans"+ans,"selected");
        }

        if(option.length>0)
        {
            str = str.replace("$optn1",option[0]);
            str = str.replace("$optn2",option[1]);
            str = str.replace("$optn3",option[2]);
            str = str.replace("$optn4",option[3]);
        }
        else
        {
            str = str.replace("$optn1","");
            str = str.replace("$optn2","");
            str = str.replace("$optn3","");
            str = str.replace("$optn4","");
        }

        return "<div class=\"panel panel-default\">"+str+"</div>";
    }

    
    </script>

    </body>
</html>