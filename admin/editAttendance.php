<?php require('../helper/dbHelper.php');?>
<?php

    if(isset($_POST['record_id']))
    {
        echo deleteAttendance($conn,$_POST['id'],$_POST['record_id']);
        die();
    }

    if(isset($_POST['id']))
    {
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $dur = mysqli_real_escape_string($conn,$_POST['duration']);
        $atten = mysqli_real_escape_string($conn,$_POST['attended']);
        $total = mysqli_real_escape_string($conn,$_POST['total']);

        echo saveAttendance($conn,$id,$dur,$atten,$total);
        die();
    }
?>

<?php require('../component/head.php'); ?>

<?php

    if(!isset($_GET["id"])) die();
    $result = getAttendance($conn,$_GET["id"]); 
?>

        <table class="table table-bordered">
        <tr>
            <th>Duration</th>
            <th>Attended</th> 
            <th>Total</th>
            <th>Average</th>
            <th>Delete</th>
        </tr>

<?php
        if($result)
        {
            while($row = $result->fetch_assoc())
            {
                extract($row);
                echo "<tr>".
                        "<td>$duration</td>".
                        "<td>$attended</td>". 
                        "<td>$total</td>".
                        "<td>".(($attended/$total)*100)."%</td>".
                        "<td align=\"center\" onclick=\"deleteAttendance($id)\"><span class=\"glyphicon glyphicon-trash\"></span></td>".
                     "</tr>";
            }
        }
?>

<tr>
    <th><input id="dur" name="duration" type="text" class="form-control"></th>
    <th><input id="atten" name="attended" type="number" class="form-control"></th> 
    <th><input id="total" name="total" type="number" class="form-control"></th>
    <th></th>
</tr>
</table>
<button onclick="save()">Submit</button>

<?php require('../component/scripts.php'); ?>

<script>
    function save()
    {
        $.post("editAttendance.php",
        {
            id: <?php echo $_GET['id'] ?>,
            duration:  $("#dur").val(),
            attended: $("#atten").val(),
            total: $("#total").val()
        },
        function(data, status){
        
            if(data=="success")
            {
                alert("Attendance updated");
                location.reload();
            }
            else
            {
                alert("Unexpected error !");
                window.close();
            }
        });
    }

    function deleteAttendance(id)
    {
        $.post("editAttendance.php",
        {
            id: <?php echo $_GET['id'] ?>,
            record_id: id
        },
        function(data, status){
        
            if(data=="success")
            {
                alert("Attendance updated");
                location.reload();
            }
            else
            {
                alert("Unexpected error !\n"+data);
                window.close();
            }
        });
    }
</script>