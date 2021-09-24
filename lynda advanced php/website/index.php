<?php
include '../request.php';
echo 'working and welcom <br>';

if(isset($_POST['submit'])){
    move_uploaded_file($_FILES['upload']['tmp_name'],'uploads/'.$_FILES['upload']['name']);
    echo 'upload completed';
}
?>
<form action="../request.php" method="get">
    <input type="submit" name="submit">
</form>

<button id="send">Send AJAX Post</button>

<form action="" method="post" enctype="multipart/form-data">

    <input type="file" name="upload">
    <input type="submit" name="submit">

</form>

<script src="../jquery-3.6.0.js"></script>
<script>
    $(function(){
       $('#send').click(function(){
            // $.post('../request.php',{
            //     'name':'islam',
            //     'age':25
            // }, function(data, status){
            //     alert(status);
            //     alert(data);
            // });
            alert('working')
       });
    })
</script>