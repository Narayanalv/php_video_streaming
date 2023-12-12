<?php
if(isset($_POST['check'])){
    session_start();
    //$check='login';
    //echo $check;
    if(isset($_SESSION['uname'])){
    if($_SESSION['uname'] != ""){
        if($_SESSION['usechannel'] !== ""){
            echo "channel";
        }else{
            echo "nochannel";
        }
    }else{
        echo "login";
    }
    }
    else{
        echo "login";
    }
}
?>