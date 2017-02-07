<!DOCTYPE HTML>
<html>
	<?php require('../helper/dbHelper.php');?>
	<?php require('../component/head.php'); ?>
	<?php 

        if(!isset($_SESSION['admin_id']))
        {
            session_destroy();
            header("Location:".$base_url);
            die();
        }

        $id = 0;
        if(isset($_GET['quiz_id']))
        {
            $id = $_GET['quiz_id'];
            $result = getQuizData($conn,$id);
            if(!$result) header("Location:".$base_url);
        }
        else
        {
            $result['title'] = "";
            $result['description'] = "";
            $result['guidelines'] = "";
            $result['time_alloted'] = 0; 
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
                <textarea id="title" class="form-control"><?php echo $result['title']; ?></textarea>
                <br>
                <h4>Description</h4>
                <textarea id="description" class="form-control" placeholder="(optional)"><?php echo $result['description']; ?></textarea>
                <br>
                <h4>Guildelines</h4>
                <textarea id="guidelines" class="form-control"><?php echo $result['guidelines']; ?></textarea>
                <br>
                <h4>Time</h4>
                <input id="time" type="text" class="form-control" placeholder="hh:mm" value="<?php echo $result['time_alloted']; ?>"/>
                <br>
                <button id="submit" class="btn btn-primary">Submit</button>

			  </div>
			  <div class="col-xs-12 col-md-9">
                    <div class="well well-lg">
                        <div id="question_list">
                        </div>
                        <button id="add_question" class="btn btn-default">Add new Question</button>
                    </div>
                    
                    <div id="question-panel" class="hidden">
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon">Q</span>
                                <input data-id="qsn" type="text" class="form-control" placeholder="Write question here" value="$qsn">
                            </div>
                            <br>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">1</span>
                                <input data-id="optn1" type="text" class="form-control" placeholder="Option 1" value="$optn1">
                            </div>
                            
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">2</span>
                                <input data-id="optn2" type="text" class="form-control" placeholder="Option 2" value="$optn2">
                            </div>

                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">3</span>
                                <input data-id="optn3" type="text" class="form-control" placeholder="Option 3" value="$optn3">
                            </div>

                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">4</span>
                                <input data-id="optn4" type="text" class="form-control" placeholder="Option 4" value="$optn4">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Marks</span>
                                    <input data-id="marks" type="number" class="form-control" value="$marks">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Negative</span>
                                    <input data-id="negative" type="number" class="form-control" value="$negative">
                                    </div>
                                </div>
                            </div>
                            
                            Answer:
                            <select class="form-control">
                                <option value=1 $ans1>Option 1</option>
                                <option value=2 $ans2>Option 2</option>
                                <option value=3 $ans3>Option 3</option>
                                <option value=4 $ans4>Option 4</option>
                            </select>
                            <div class="quiz-alert alert alert-danger hidden">
                            <button type="button" class="close" onclick="dismiss(this)"><span>&times;</span></button>
                                <span class="glyphicon glyphicon-exclamation-sign"></span> One or more field(s) are Invalid
                            </div>
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

        $("#add_question").click(function(){
            var v = frameQuestion();
            $("#question_list").append(v);
        });

        getQuestion(<?php echo $id ?>);
        formatTime();

        $("#submit").click(submit);
    });

    function formatTime()
    {
        var val = $("#time").val();
        $("#time").val(secToTime(val));
    }

    function secToTime(duration) {
        if(duration==0) return "";
        var minutes = parseInt((duration/(60))%60)
            , hours = parseInt((duration/(60*60))%24);

        hours = (hours < 10) ? "0" + hours : hours;
        minutes = (minutes < 10) ? "0" + minutes : minutes;
        return hours + ":" + minutes;
    }

    function getQuestion(id)
    {
        if(id==0) return;

        $.post("getQuestions.php",{id:id},
        function(data, status){
            var data = JSON.parse(data);
            if(data.status=="success")
            {
                var str ="";
                for(var i=0; i<data.items.length; i++)
                {
                    var item = data.items[i];
                    var v = frameQuestion(item.question,item.options,item.ans,item.marks,item.negative);
                    str +=v;
                }
                $("#question_list").append(str);                
            }
            else
            {
                console.log(data);
            }
        });
    }

    function dismiss(v)
    {
        $(v).parent().addClass("hidden");
    }

    function submit()
    {

        var result = packData();
        var data = JSON.stringify(result);
        var id = <?php echo $id ?>;

        if(result.questions.length>0)
        {
            //send data to server
            $.post("createTest.php",{id:id,data:data},
                function(data, status){
                    data = JSON.parse(data);
                    if(data.status == "success" && id==0)
                    {
                        alert("Quiz Saved !!");
                        window.location = window.location.href+"?quiz_id="+data.id;
                    }
                    else if(data.status == "success")
                    {
                        alert("Quiz Saved !!");;
                    }
                    else
                    {
                        console.log(data);
                    }
                });
        }
        else
        {
            alert("No Questions Added.");
        }
    }

    function getTextarea(v)
    {
        return $(v).val().replace(/\r\n|\r|\n/g,"<br />");
    }

    function del(v)
    {
        $(v).parent().remove();
    }

    function frameQuestion(qsn="",option=[],ans="",marks=1,negative=0)
    {
        var str = $("#question-panel").html();
        str = str.replace("$qsn",qsn);
        str = str.replace("$marks",marks);
        str = str.replace("$negative",negative);

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

        return "<div class=\"panel panel-default qsn-panel\">"+str+"</div>";
    }

    function packData()
    {
        data = {
            title: getTextarea("#title"),
            description: getTextarea("#description"),
            guidelines: getTextarea("#guidelines"),
            time: getTime(),
            max_marks: 0,
            questions: []
        };

        if(data.title =="" || data.guidelines =="")
        {
            alert("Title and Guidelines are mandatory.");
            return false;
        }

        if(data.time == false)
        {
            alert("Invalid Test Time.\nShould be in Hour:Minute format.");
            return false;
        }

        total_marks = 0;

        $(".qsn-panel").each(function(){

            var qsn = $(this).find("input[data-id='qsn']").val();
            var optn1 = $(this).find("input[data-id='optn1']").val();
            var optn2 = $(this).find("input[data-id='optn2']").val();
            var optn3 = $(this).find("input[data-id='optn3']").val();
            var optn4 = $(this).find("input[data-id='optn4']").val();

            var marks = parseInt($(this).find("input[data-id='marks']").val());
            var negative = parseInt($(this).find("input[data-id='negative']").val());

            var answer = parseInt($(this).find("select").val());
           

            var result = {qsn:qsn,optn1:optn1,optn2:optn2,optn3:optn3,optn4:optn4,ans:answer,marks:marks,negative:negative};

            if(qsn=="" && optn1=="" && optn2=="" && optn3=="" && optn4=="")
            {
                $(this).find("div.hidden").removeClass("hidden");
            }

            total_marks=total_marks+marks; 
            data.questions.push(result);
            data.max_marks = total_marks;

        });
        console.log(data);
        return data;
    }

    function getTime()
    {
        var parts = $("#time").val().split(":");
        if(parts.length !== 2)
        {
            return false;
        }
        else
        {
            var time = (parseInt(parts[0])*60*60)+(parseInt(parts[1])*60);
            if(!time) time = false;
            return time;
        }
    }
    
    </script>

    </body>
</html>