<?php
session_start();
include ('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel='icon' type='image/x-icon' href='./imgs/logo.png'/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="loginstyle.css">
    <script src="jquery-3.7.0.min.js"></script>
</head>
<body style="background: #cdcdff;">
<div class="loginh" style="background: white;">
<img src='./imgs/logo.png' style="width:100px;height:100px;margin-top:20px;">
        <div>
            <p style="margin-top: 10px;font-size: 25px;"><b>Tube Stream</b></p>
        </div>
            <div id="forgotp">
                <form action="" method="POST" class="form1">
            <p style="font-size: 23px;">Forgot Password</p>
            <div>
                <input class="femail" style="z-index:2;background-color:transparent;" type="email" name="uemail">
                <p class="feh" style="z-index:1;">Enter your Email</p>
            </div>
            <p class="matc" style="color: red;visibility: hidden;margin-left: -100px;height: 5px;margin-top: 0px;">Email does not exist</p>
            <p style="justify-content: left;">
                One time O.T.P is sent to your Email
            </p>
            <input class="resetpass" style="margin-top:0px;width: 80px;height: 30px;border-color: rgb(238, 238, 238);" type="submit" value="Send" name="send">
            </form>
            <form class="form2" action="" method="POST" style="display:none;">
            <div style="margin-top: 30px;">
                <input class="rotp" type="text" name="otp">
                <p class="otp">Enter O.T.P</p>
            </div>
            <p class="match" style="color: red;visibility: hidden;margin-left: -100px;height: 5px;margin-top: 0px;">O.T.P is wrong</p>
                <div>
                    <input id="b2" style="margin-top:40px;width: 80px;height: 30px;margin-right: 30px;border-color: rgb(238, 238, 238);" type="button" value="Back" onclick="">
                    <input id="verify" style="margin-top:0px;width: 80px;height: 30px;margin-left: 30px;border-color: rgb(238, 238, 238);" type="submit" value="verify" name="verify">
                </div>
            </form>
            </div>
        </div>
        </div>
        <script>
            const form1=document.querySelector('.form1');
            const form2=document.querySelector('.form2');
            const rotp=document.querySelector(".rotp");
            const matc=document.querySelector(".matc");
            const match=document.querySelector(".match");
            const rph=document.querySelector(".rph");
            const femail=document.querySelector(".femail");
            const feh=document.querySelector(".feh");
            const resetpass=document.querySelector('.resetpass');
            const b2=document.querySelector('.b2');
const otp=document.querySelector(".otp");
rotp.addEventListener('keyup',() => {
        otp.style.fontSize="15px";otp.style.marginTop="-45px";otp.style.position="absolute";otp.style.zIndex="2";otp.style.width="80px";otp.style.backgroundColor="white";otp.style.marginLeft="110px";
        if(rotp.value==""){
            otp.style.fontSize="20px";otp.style.marginLeft="70px";otp.style.marginTop="-28px";otp.style.zIndex="1";otp.style.width="auto";otp.style.backgroundColor="white";otp.style.marginLeft="110px";
        }
});
rotp.addEventListener('focusin',() => {
    if (rotp.value!=""){
        otp.style.fontSize="15px";otp.style.marginTop="-45px";otp.style.position="absolute";otp.style.zIndex="2";otp.style.width="80px";otp.style.backgroundColor="white";otp.style.marginLeft="110px";
    }
    else{
        otp.style.fontSize="20px";otp.style.marginLeft="70px";otp.style.marginTop="-28px";otp.style.zIndex="1";otp.style.width="auto";otp.style.backgroundColor="white";otp.style.marginLeft="110px";
    }
})
rotp.addEventListener('focusout',() => {
    if (rotp.value!=""){
        otp.style.fontSize="15px";otp.style.marginTop="-45px";otp.style.position="absolute";otp.style.zIndex="2";otp.style.width="80px";otp.style.backgroundColor="white";otp.style.marginLeft="110px";
    }
    else{
        otp.style.fontSize="20px";otp.style.marginLeft="70px";otp.style.marginTop="-28px";otp.style.zIndex="1";otp.style.width="auto";otp.style.backgroundColor="white";otp.style.marginLeft="110px";
    }
})
femail.addEventListener('keyup',() => {
        feh.style.fontSize="15px";feh.style.marginTop="-45px";feh.style.position="absolute";feh.style.zIndex="2";feh.style.width="120px";feh.style.backgroundColor="white";
        if(femail.value==""){
            feh.style.fontSize="20px";feh.style.marginLeft="70px";feh.style.marginTop="-28px";feh.style.zIndex="1";feh.style.width="auto";feh.style.backgroundColor="white";
        }
});
femail.addEventListener('focusin',() => {
    if (femail.value!=""){
        feh.style.fontSize="15px";feh.style.marginTop="-45px";feh.style.position="absolute";feh.style.zIndex="2";feh.style.width="120px";feh.style.backgroundColor="white";
    }
    else{
        feh.style.fontSize="20px";feh.style.marginLeft="70px";feh.style.marginTop="-28px";feh.style.zIndex="1";feh.style.width="auto";feh.style.backgroundColor="white";
    }
})
femail.addEventListener('focusout',() => {
    if (femail.value!=""){
        feh.style.fontSize="15px";feh.style.marginTop="-45px";feh.style.position="absolute";feh.style.zIndex="2";feh.style.width="120px";feh.style.backgroundColor="white";
    }
    else{
        feh.style.fontSize="20px";feh.style.marginLeft="70px";feh.style.marginTop="-28px";feh.style.zIndex="1";feh.style.width="auto";feh.style.backgroundColor="white";
    }
})
b2.addEventListener('click',()=>{
    window.location.href = 'passreset.php';
})
        </script>
</body>
</html>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['send']) && isset($_POST['uemail'])){
    $useremail=$_POST['uemail'];
    $_SESSION['rpemail']=$_POST['uemail'];
    $sql = "select * from login where email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
require 'extra\libraries\vendor\autoload.php';
require 'extra\PHPMailer.php';
require 'extra\SMTP.php';
require 'extra\Exception.php';
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = '';//sender mail address
    $mail->Password   = '';//password
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $htmlTemplate = file_get_contents('extra\email.html');
    $otp=rand(1000,9999);
    $_SESSION['otp']=$otp;
    $rest="password reset";
    $mail->setFrom('tubestreamac@gmail.com', 'TubeStream');
    $mail->addAddress($useremail);
    $htmlTemplate = str_replace('verification', $rest, $htmlTemplate);
    $htmlTemplate = str_replace('{{OTP}}', $otp, $htmlTemplate);
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body = $htmlTemplate;
    $mail->SMTPDebug = 0;
    $mail->send();
    echo "<script>alert('mail sent successfully')
    form1.style.display='none';
    form2.style.display='block';</script>";
    unset($_POST['send']);
    unset($_POST['uemail']);
} catch (Exception $e) {
    echo "<script>alert('mail could not send');</script>";
}
}
}
if(isset($_POST['verify']) && isset($_POST['otp'])){
    if($_SESSION['otp']==$_POST['otp']){
        echo "<script>
                        window.location.href = 'passreset.php';
                    </script>";
    }
}
