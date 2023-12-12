<?php
if (isset($_POST['submit']) && isset($_FILES['my_video']) && isset($_POST['newname'])) {
	include "connection.php";
    $video_name = $_FILES['my_video']['name'];
    $tmp_name = $_FILES['my_video']['tmp_name'];
    $error = $_FILES['my_video']['error'];
	$newname=$_POST['newname'];
	session_start();
    $id=$_SESSION['id'];
    $cname=$_SESSION['usechannel'];
    if ($error === 0) {
    	$video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
    	$video_ex_lc = strtolower($video_ex);
    	$allowed_exs = array("mp4", 'webm', 'avi', 'flv');
    	if(in_array($video_ex_lc, $allowed_exs)){
    		$new_video_name = uniqid("video-", true). '.'.$video_ex_lc;
    		$video_upload_path = 'src/'.$new_video_name;
    		move_uploaded_file($tmp_name, $video_upload_path);
            $sql = "INSERT INTO main(`videoname`,`description`,`cname`,`uid`)
			VALUES('$new_video_name','$newname','$cname','$id')";
            mysqli_query($conn, $sql);
			echo "<script>alert('upload Sucess full');
			window.location.href = 'myac.php';</script>";
    	}else {
    		$em = "You can't upload files of this type";
    		echo "<script>alert('$em');
			window.location.href = 'myac.php';</script>";
    	}
    }
}else{
	echo "<script>alert('file select the file or write the description');
		window.location.href = 'myac.php';</script>";
}
?>