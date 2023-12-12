<?php
include('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST")
if(isset($_POST['submit'])){
//if button with the name uploadfilesub has been clicked
//declaring variables
session_start();
if($_FILES['image']['error'] == 0 && $_POST['channelname']!=null && $_POST['channelname']!=''){
    if(isset($_SESSION['id'])){
$id=$_SESSION['id'];
$profile = file_get_contents($_FILES['image']['tmp_name']);
$channelname= $_POST['channelname'];
$_SESSION['usechannel']=$channelname;
$stmt = $conn->prepare("insert into channel(`lid`,`channelname`, `profile`) values (?,?,?)");
$stmt->bind_param("iss", $id,$channelname,$profile,);
$stmt->execute();
$sql="UPDATE `login` SET `channelname`='$channelname' WHERE `id`='$id';";
$qry = mysqli_query($conn, $sql);
if($qry) {
    echo "<script>
            alert('Account Created Successfully');
            window.location.href = 'tubestream.php';
        </script>";
        exit;
}
}else{
    echo '<script>
            alert("Login create channel");
            window.location.href = "login.php";
            </script>';
            exit;
}
}else{
    echo '<script>
            alert("You should fill");
            window.location.href = "ccreate.php";
    </script>';
    exit;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel='icon' type='image/x-icon' href='./imgs/logo.png'/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Channel Creation </title>
    <style type="stylesheet">
        *{display: inline-block;text-align: center;vertical-align: middle;margin-left: 100px;background-color:#e6dff7;}
    </style>
</head>
<body>
    <div>
        <center><h1>Channel creation</h1><br></center>
        <form method="post" enctype="multipart/form-data">
    <div style="display: block;margin-left: 100px;position: relative;width: 500px;height: 100%;margin-top: 100px;">
        <div style="display: inline-block;">
            <h3 style="display: inline-block;">Channel Name</h3>
            <input class="cname" style="margin-left: 50px;display: inline-block;" type="text" name="channelname"></div><br>
        <div style="display: inline-block;">
            <h3 style="display: inline-block;">Channel Logo</h3>
            <input style="margin-left: 50px;display: inline-block;"class="image" id="imageInput1" type="file" name="image">
            <h6 style="display: inline-block;margin-left: -65px;">(max size 2mb)</h6></div><br>
        <div>
        <input type="submit" name="submit" value='submit'>
    </div>
    <div style="width:50%;height:300px;margin-left: 600px;margin-top: -250px;">
        <div id="imageContainer" style="width: 500px;height:50px;background-size: cover;background-position: center;border: 1px solid #000;"><label class="label"></label></div>
        <div id="imageContainer1" style="background-size: cover;background-position: center;position: absolute;width: 100px;height: 100px;border-radius: 60px;z-index: 10;margin-left: 200px;border: 1px solid #000;"></div>
    </div>
</form>
</div>
<script>
    document.getElementById('imageInput1').addEventListener('change', function (e) {
    const imageFile = e.target.files[0];

    if (imageFile) {
        const reader = new FileReader();

        reader.onload = function (event) {
            const imageContainer = document.getElementById('imageContainer1');
            imageContainer.style.backgroundImage = `url(${event.target.result})`;
        };

        reader.readAsDataURL(imageFile);
    }
});
const cname=document.querySelector('.cname');
cname.addEventListener('input',()=>{
    var label=document.querySelector('.label');
    label.textContent=cname.value;
})
</script>
</body>
</html>