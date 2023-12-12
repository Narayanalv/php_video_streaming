<?php
include('connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    if(isset($_SESSION['id'])){
        $id=$_SESSION['id'];
        $name=$_SESSION['name'];
    if(isset($_POST['comt']) && isset($_POST['vid']) && $_POST['comt'] != '' && $_POST['vid'] != ''){
        $comt = $_POST['comt'];
        $vid = $_POST['vid'];
        $stmt = $conn->prepare("INSERT INTO `comment`(`vid`, `ucid`, `name`, `comment`) VALUES (?,?,?,?)");
        $stmt->bind_param("iiss", $vid,$id,$name,$comt);
        if ($stmt->execute()) {
            echo 'succ';
        } else {
            echo 'error';
        }        
        $stmt->close();
    } else {
        echo 'Missing or empty values for comment and/or vid';
    }
} else {
    echo 'login';
}
}else{
    echo 'Invalid request method';
}
?>
