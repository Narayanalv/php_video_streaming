<?php
include ('connection.php');
session_start();
if(isset($_POST['inputString'])){
    if(isset($_SESSION['id']) && $_SESSION['id']!=null && $_SESSION['id']!=''){
        $uid=$_SESSION['id'];
    $vname=$_POST['inputString'];
    $stmt = $conn->prepare("SELECT `view`, `id` FROM `main` WHERE `videoname` = ?");
    $stmt->bind_param("s", $vname);
    $stmt->execute();
    $result = $stmt->get_result();
    $jsonData=array();
if($row=$result->fetch_assoc()){
    $vid=$row['view'];
    $id=$row['id'];
    if($vid!=null){

    }else{
            $vid=1;
    }
    $ar=array();
    $sql = "SELECT `history` FROM `login` WHERE `id`=$uid";
    $result = $conn->query($sql);
    //$jsonArray = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if($row['history']!=null){
                    $Array = $row['history'];
                    $ar = explode(" ", $Array);
                    if (in_array($id, $ar)) {
                        echo 'The array contains';
                    }else{
                        if ($Array !== null) {
                            $Array=$Array." ".$id;
                            $sql2 = "UPDATE `login` SET `history`='$Array' WHERE id=$uid";
                            if ($conn->query($sql2) === false) {
                                echo "Error: " . $sql1 . "<br>" . $conn->error;
                            }
                            $vid=$vid+1;
                        }
                    }
                }else{
                        // Insert JSON string into database
                    $Array=$id;
                    $Array=json_encode($Array);
                    $sql1 = "UPDATE `login` SET `history`='$Array' WHERE `id`=$uid";
                    if ($conn->query($sql1) === false) {
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }
                }
            }
        }
            $stmt = $conn->prepare("UPDATE `main` SET `view` = ? WHERE `id` = ?");
        $stmt->bind_param("ii", $vid, $id);
        if($stmt->execute()){
            echo 'successful';
        }else{
            echo 'error reload the page';
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