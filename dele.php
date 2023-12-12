<?php
include("connection.php");
if($_POST['videoname']){
    $vname=$_POST['videoname'];
    $stmt=$conn->prepare("DELETE FROM `main` WHERE `videoname`=?");
    $stmt->bind_param("s", $vname);
    $stmt->execute();
    if($stmt->execute===true){
        echo "success";
    }else{
        echo 'error';
    }
}else{
    echo "vname";
}
?>