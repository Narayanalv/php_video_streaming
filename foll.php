<?php
include('connection.php');
if(isset($_POST['chid'])){
    $chid=$_POST['chid'];
    session_start();
    if(isset($_SESSION['id']) && $_SESSION['id']!=''){
        $stmt=$conn->prepare("SELECT `followers` FROM `channel` WHERE `lid`=?");
    $stmt->bind_param("s",$chid);
    $stmt->execute();
    $res1 = $stmt->get_result();
    if($row=$res1->fetch_assoc()){
        if($row['followers']!=null && $row['followers']!=''){
            $follower=$row['followers'];
        }else{
            $follower=0;
        }
    }
        $id=$_SESSION['id'];
        $sql="SELECT `following` from `login` where id=$id";
        $result=$conn->query($sql);
        if($result->num_rows > 0){
            $row=$result->fetch_assoc();
            $following=$row['following'];
            if($following!=null && $following!=''){
                $foll=explode(" ",$following);
                if(in_array($chid,$foll)){
                    $ind=array_search($chid,$foll);
                    unset($foll[$ind]);
                    $follow=implode(" ",$foll);
                    $follower-=1;
                    $var="d";
                }else{
                        $foll=implode(" ",$foll);
                        $follow=$foll." ".$chid;
                        $follower+=1;
                        $var="a";
                    }
            }else{
                $follow=$chid;
                $follower+=1;
                $var="a";
            }
                    $stmt=$conn->prepare("UPDATE `login` SET `following`=? WHERE `id`=?");
                    $stmt->bind_param("si",$follow,$id);
                    if($stmt->execute()===false){
                        echo "error";
                    }else{
                        $stmt->close();
                        $stmt=$conn->prepare("UPDATE `channel` SET `followers`=? WHERE `lid`=?");
                        $stmt->bind_param("ii",$follower,$chid);
                        if($stmt->execute()===false){
                            echo "error";
                        }else{
                            $stmt->close();
                            echo "succ".$var;
                        }
                    }
        }
    }else{
        echo "login";
    }
}
?>