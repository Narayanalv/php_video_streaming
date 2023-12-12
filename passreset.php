<?php
session_start();
include('connection.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
<div class="loginh">
<img src='./imgs/logo.png' style="width:100px;height:100px;margin-top:20px;">
        <div>
            <p style="margin-top: 10px;font-size: 25px;">Tube Stream</p>
        </div>
            <div id="prset">
                <form action="" method="POST">
            <p style="font-size: 23px;">Password reset</p>
            <div style="margin-top: 20px;">
                <input class="rpasset" type="password" name="passward">
                <p class="rpset">Enter password</p>
            </div>
            <div style="margin-top: 30px;">
                <input class="rpasset1" type="password">
                <p class="rpset1">Confirm password</p>
            </div>
            <p class="match1" style="color: red;visibility: hidden;margin-left: -100px;height: 5px;margin-top: 0px;">Password does not match</p>
            <div class="check"><input class="checksp" type="checkbox"><span class="rsetc">show password</span></div>
            <div>
                <input id="ver" style="margin-top:20px;width: auto;height: 30px;border-color: rgb(238, 238, 238);" type="button" value="Set Password">
            </div>
            </form>
        </div>
        </div>
        <script>
            //const signup=document.getElementById('Signup');
            const prset=document.getElementById('prset');
            const rpasset=document.querySelector(".rpasset");
const rpset=document.querySelector(".rpset");
const match1=document.querySelector('.match1');
const rsetc=document.querySelector('.rsetc');
const ver=document.getElementById('ver');
const rpasset1=document.querySelector(".rpasset1");
const rpset1=document.querySelector(".rpset1");
rsetc.addEventListener('click', () => {
    if(checksp.checked){
        rpasset1.setAttribute("type","text");
        rpasset.setAttribute("type","text");
    }
    else{
        rpasset1.setAttribute("type","password");
        rpasset.setAttribute("type","password");
    }
})
const checksp=document.querySelector('.checksp');
checksp.addEventListener('change',() => {
    if(checksp.checked){
        rpasset1.setAttribute("type","text");
        rpasset.setAttribute("type","text");
    }
    else{
        rpasset1.setAttribute("type","password");
        rpasset.setAttribute("type","password");
    }
})
rsetc.addEventListener('click', function(){
    checksp.checked = !checksp.checked;
})
rpasset.addEventListener('keypress',() => {
        rpset.style.fontSize="15px";rpset.style.marginTop="-45px";rpset.style.position="absolute";rpset.style.zIndex="1";rpset.style.width="120px";rpset.style.backgroundColor="white";
        match1.style.visibility='hidden';
});
rpasset.addEventListener('focusin',() => {
    match1.style.visibility='hidden';
    if (rpasset.value!=""){
        rpset.style.fontSize="15px";rpset.style.marginTop="-45px";rpset.style.position="absolute";rpset.style.zIndex="1";rpset.style.width="120px";rpset.style.backgroundColor="white";
    }
    else{
        rpset.style.fontSize="20px";rpset.style.marginLeft="70px";rpset.style.marginTop="-28px";rpset.style.zIndex="-10";rpset.style.width="auto";rpset.style.backgroundColor="white";
    }
})
rpasset.addEventListener('focusout',() => {
    if (rpasset.value!=""){
        rpset.style.fontSize="15px";rpset.style.marginTop="-45px";rpset.style.position="absolute";rpset.style.zIndex="1";rpset.style.width="120px";rpset.style.backgroundColor="white";
        if(rpasset1.value==rpasset.value){
            match1.style.visibility='hidden';
            ver.setAttribute("type","submit");
        }
        else{
            match1.style.visibility='visible';
        }
    }
    else{
        rpset.style.fontSize="20px";rpset.style.marginLeft="70px";rpset.style.marginTop="-28px";rpset.style.zIndex="-10";rpset.style.width="auto";rpset.style.backgroundColor="white";
    }
})
rpasset1.addEventListener('keypress',() => {
        rpset1.style.fontSize="15px";rpset1.style.marginTop="-45px";rpset1.style.position="absolute";rpset1.style.zIndex="1";rpset1.style.width="120px";rpset1.style.backgroundColor="white";
        match1.style.visibility='hidden';
});
rpasset1.addEventListener('focusin',() => {
    match1.style.visibility='hidden';
    if (rpasset1.value!=""){
        rpset1.style.fontSize="15px";rpset1.style.marginTop="-45px";rpset1.style.position="absolute";rpset1.style.zIndex="1";rpset1.style.width="120px";rpset1.style.backgroundColor="white";
    }
    else{
        rpset1.style.fontSize="20px";rpset1.style.marginLeft="70px";rpset1.style.marginTop="-28px";rpset1.style.zIndex="-10";rpset1.style.width="auto";rpset1.style.backgroundColor="white";
    }
})
rpasset1.addEventListener('focusout',() => {
    if (rpasset1.value!=""){
        rpset1.style.fontSize="15px";rpset1.style.marginTop="-45px";rpset1.style.position="absolute";rpset1.style.zIndex="1";rpset1.style.width="120px";rpset1.style.backgroundColor="white";
        if(rpasset1.value==rpasset.value){
            match1.style.visibility='hidden';
            ver.setAttribute("type","submit");
        }
        else{
            match1.style.visibility='visible';
        }
    }
    else{
        rpset1.style.fontSize="20px";rpset1.style.marginLeft="70px";rpset1.style.marginTop="-28px";rpset1.style.zIndex="-10";rpset1.style.width="auto";rpset1.style.backgroundColor="white";
    }
})
        </script>
</body>
</html>
<?php
if(isset($_POST['passward']) && isset($_SESSION['rpemail'])){
if($_SESSION['rpemail']!=null && $_SESSION['rpemail']!=""){
$passward=$_POST['passward'];
$useremail=$_SESSION['rpemail'];
$sql="UPDATE `login` SET `passward`=? WHERE `email`=?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("ss", $passward, $useremail);
    if ($stmt->execute()) {
        echo "<script>alert('Password updated successfully');
        window.location.href = 'login.php';</script>";
    } else {
        echo "Error updating password: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
$conn->close();
}else{
    echo "<script>alert('something went wrong try again');
    window.location.href = 'login.php';</script>";
}
}
?>