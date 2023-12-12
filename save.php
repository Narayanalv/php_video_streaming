<?php
include ('connection.php');
session_start();
if(isset($_POST['inputString'])){
    if(isset($_SESSION['id'])!=""){
        $uid=$_SESSION['id'];
    $vname=$_POST['inputString'];
    $stmt = $conn->prepare("SELECT `id` FROM `main` WHERE `videoname` = ?");
    $stmt->bind_param("s", $vname);
    $stmt->execute();
    $result = $stmt->get_result();
if($row=$result->fetch_assoc()){
    $id=$row['id'];
    $stmt->close();
    $ar=array();
    $sql = "SELECT `save` FROM `login` WHERE `id`=$uid";
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if($row['save']!=null){
                    $Array = $row['save'];
                    $ar = explode(" ", $Array);
                    if (in_array($id, $ar)) {
                        $ind=array_search($id,$ar);
                        unset($ar[$ind]);
                        $Array=implode(" ",$ar);
                        $sql2 = "UPDATE `login` SET `save`='$Array' WHERE id=$uid";
                        if ($conn->query($sql2) === false) {
                            echo "Error: ";
                        }
                        echo "./imgs/save.png";
                    }else{
                        if ($Array !== null) {
                            $Array=$Array." ".$id;
                            $sql2 = "UPDATE `login` SET `save`='$Array' WHERE id=$uid";
                            if ($conn->query($sql2) === false) {
                                echo "Error: ";
                            }
                            echo "./imgs/asaved.png";
                        }
                    }
                }else{
                    $Array=$id;
                    $sql1 = "UPDATE `login` SET `save`='$Array' WHERE `id`=$uid";
                    if ($conn->query($sql1) === false) {
                        echo "Error: ";
                    }
                    echo "./imgs/asaved.png";
                }
            }
        }
    }else{
        echo 'error reload the page';
    }
}else{
    echo "login";
}
}else{
    echo "error reload the page";
}
?>