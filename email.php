<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>verify</title>
                    <link rel="stylesheet" href="loginstyle.css">
                    <script src="jquery-3.7.0.min.js"></script>
                </head>
                <body style="background: #cdcdff;">
                <div class="loginh" style="background: white;">
                <div>
                <img src='./imgs/logo.png' style="width:100px;height:100px;margin-top:20px;">
                <div>
                        <p style="margin-top: 20px;font-size: 25px;"><b>Tube Stream</b></p>
                    </div>
                    <div align="center">
                        <form action="" method="POST">
                            <pre><b style="font-size:20px;"> Enter OTP that is sent to
your email  address</b></pre>
                        <p class="ot" style="color:red;margin-left: -20px;visibility:hidden;">OTP is incorrect<p>
                        <input class="otpver" type="text" placeholder="Enter OTP" name="verify" style="margin-left:-10px;height:20px;border-radius:10px;">
                        <input type="submit" value="submit">
                    </form>
                </div>
            </div>
        </div>
        <script>
            const ot=document.querySelector('.ot');
            const otpver=document.querySelector('.otpver');
            otpver.addEventListener('focusin',() =>{
                otpver.style.border="1px solid black";
                ot.style.visibility="hidden";
            })
            $(document).ready(function() {
                otpver.style.border="1px solid black";
                ot.style.visibility="hidden";
            });
        </script>
    </body>
</html>
<?php
include ('connection.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['send'])){
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
    $mail->Username   = 'tubestreamac@gmail.com';
    $mail->Password   = 'hznlkvdtkkfehizl';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $htmlTemplate = file_get_contents('extra\email.html');
    $otp=rand(1000,9999);
    $_SESSION['otp']=$otp;
    $mail->setFrom('tubestreamac@gmail.com', 'TubeStream');
    $mail->addAddress($_SESSION['temail']);
    $htmlTemplate = str_replace('{{OTP}}', $otp, $htmlTemplate);
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body = $htmlTemplate;
    $mail->SMTPDebug = 0;
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
if(isset($_POST['verify'])){
    if($_POST['verify']==$_SESSION['otp']){
        echo "hell";
        $username=$_SESSION['tname'];
        $useremail=$_SESSION['temail'];
        $password=$_SESSION['tpass'];
        $sql = "insert INTO login(name,email, passward) VALUES ('$username','$useremail','$password')";
        if ($conn->query($sql) === TRUE) {
            unset($_SESSION['otp']);
            unset($_SESSION['tname']);
            unset($_SESSION['temail']);
            unset($_SESSION['tpass']);
            echo "<script>
                        alert('Registration successful!')
                        window.location.href = 'login.php';
                    </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            for($i=0; $i<=10; $i++)
            {
                sleep(5);
            }
            echo  "<script>
                        alert('registeration failed. try agian')
                        window.location.href = 'register.php';
                    </script>";
        }
    }else{
        echo "<script>alert('wrong otp');</script>";
    }
}
?>