<?php
include ("connection.php");
session_start();
if(isset($_POST['vname'])){
    if(isset($_SESSION['id'])!=null){
    $vname=$_POST['vname'];
    $id=$_SESSION['id'];
    $stmt = $conn->prepare("SELECT `id`,`likeno` FROM `main` WHERE `videoname`=?");
    $stmt->bind_param("s", $vname);
    $stmt->execute();
    $res = $stmt->get_result();
    if($row=$res->fetch_assoc()){
        $vid=$row['id'];
        if($row['likeno']!=null){
        $like=$row['likeno'];
        }else{
            $like=0;
        }
    }
    $stmt->close();
    $stmt=$conn->prepare("select `likev` from `login` where `id`=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if($row=$res->fetch_assoc()){
        if($row['likev']!=null && $row['likev']!=''){
        $liked=$row['likev'];
        $liar=explode(" ",$liked);
        if(in_array($vid,$liar) && $liked=$vid){
            echo "./imgs/arlike.png";
        }else{
            echo "./imgs/like.png";
        }
    }
    $stmt->close();
    $vid='';
    $liked="";
    $like="";
}
}
}
if(isset($_POST['acvname'])){
    if(isset($_SESSION['id'])!=null){
    $vname=$_POST['acvname'];
    $id=$_SESSION['id'];
    $stmt = $conn->prepare("SELECT `id`,`likeno` FROM `main` WHERE `videoname`=?");
    $stmt->bind_param("s", $vname);
    $stmt->execute();
    $res = $stmt->get_result();
    if($row=$res->fetch_assoc()){
        $vid=$row['id'];
        if($row['likeno']!=null && $row['likeno']!=''){
        $like=$row['likeno'];
        }else{
            $like=0;
        }
    }
    $stmt->close();
    $stmt=$conn->prepare("select `likev` from `login` where `id`=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res1 = $stmt->get_result();
    if($row=$res1->fetch_assoc()){
        if($row['likev']!=null && $row['likev']!=''){
        $liked=$row['likev'];
        $liar=explode(" ",$liked);
        if(in_array($vid,$liar)){
            
        }else{
                $liked=implode(" ",$liar);
                $liked=$liked." ".$vid;
                $sql2 = "UPDATE `login` SET `likev`='$liked' WHERE id=$id";
                if ($conn->query($sql2) === false) {
                    echo "Error: " . $sql1 . "<br>";
                }
                $like+=1;
        }
    }else{
        $liked=$vid;
        $liked=json_encode($liked);
        $sql1 = "UPDATE `login` SET `likev`='$liked' WHERE `id`=$id";
        if($conn->query($sql1) === false){
            echo "Error: " . $sql1 . "<br>";
        }
        $like+=1;
    }
    }
    $stmt->close();
    $stmt = $conn->prepare("UPDATE `main` SET `likeno`=? where `id`=?");
    $stmt->bind_param("si", $like,$vid);
    if ($stmt->execute()=== false) {
        echo "Error: " . $sql2 . "<br>";
    }else{
        echo "./imgs/arlike.png "."$like "."liked";
    }
    $stmt->close();
}
$vid=0;
$liked="";
$like="";
}
if(isset($_POST['dcvname'])){
    if(isset($_SESSION['id'])!=null){
    $vname=$_POST['dcvname'];
    $id=$_SESSION['id'];
    $stmt = $conn->prepare("SELECT `id`,`likeno` FROM `main` WHERE `videoname`=?");
    $stmt->bind_param("s", $vname);
    $stmt->execute();
    $res = $stmt->get_result();
    if($row=$res->fetch_assoc()){
        if($row['likeno']!=null){
        $like=$row['likeno'];
        }else{
            $like=0;
        }
        $vid=$row['id'];
    }
    $stmt->close();
    $stmt=$conn->prepare("select `likev` from `login` where `id`=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if($row=$res->fetch_assoc()){
        if($row['likev']!=null){
        $liked=$row['likev'];
        $liar=explode(" ",$liked);
        if(in_array($vid,$liar)){
            $ind=array_search($vid,$liar);
            unset($liar[$ind]);
            $liked=implode(" ",$liar);
            if ($liked !== null) {
                $sql2 = "UPDATE `login` SET `likev`='$liked' WHERE id=$id";
                $like-=1;
                if ($conn->query($sql2) === false) {
                    echo "Error: " . $sql1 . "<br>";
                }
            }
        }
    }
}
$stmt->close();
$stmt = $conn->prepare("UPDATE `main` SET `likeno`=? where `id`=?");
    $stmt->bind_param("si", $like,$vid);
    echo "./imgs/like.png "."$like"." deleted";
    if ($stmt->execute()=== false) {
        echo "Error: " . $sql2 . "<br>";
    }
    $stmt->close();
}
$vid='';
$liked="";
$like="";
}
?>