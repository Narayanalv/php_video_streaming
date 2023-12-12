<?php
include("connection.php");
if (isset($_POST['login']))
{
    $username = $_POST['logemail'];
    $password = $_POST['logpass'];
        // Call the PHP function to check if the email exists in the database
        $query = "select COUNT(*) FROM login WHERE email = '$username'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_fetch_row($result)[0];
    if ($count > 0) {
    $sql = "select * from login where email ='$username' and passward = '$password'";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    if($count > 0){
        session_start();
            $_SESSION['id']=$row['id'];
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            $_SESSION['uname']=$username;
            $_SESSION['upass']=$password;
            $_SESSION['usechannel']=mysqli_fetch_row($result)[4];
            $_SESSION['name']=$row['name'];
            $na=$_SESSION['name'];
        echo  "<script>
                    alert('Login Successfull');
                    window.location.href = 'tubestream.php';
                </script>";
    }
    else{
        echo  '<script>
                    alert("Login failed. Invalid password!!")
                    ma1.style.visible="visible";
                    window.location.href = "login.php";
                </script>';
                $vis="visible";
    }
        } else {
            echo  '<script>
                    ma.style.visibility="visible";
                    window.location.href = "login.php";
                </script>';
                $visi="visible";
        }
    }         
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel='icon' type='image/x-icon' href='./imgs/logo.png'/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginstyle.css">
    <title>Login</title>
    <style>
        .ma{visibility:hidden;}
        .ma1{visibility:hidden;}
        .eh, .ph{z-index: 1;background-color:white;}
        input{z-index: 2;}
    </style>
</head>
<body style="background: #cdcdff;">
    <div class="loginh" style="background-color:white;">
        <div>
            <p style="margin-top: 30px;font-size: 25px;background-color:white;">Tube Stream</p>
        </div>
        <div id="log">
            <form action="" method="POST" style="background-color:white;">
            <p style="font-size: 25px;background-color:white;">Login</p>
            <div style="margin-top: 30px;background-color:transparent;">
                <input class="email" type="email" name="logemail" required>
                <p class="eh">Enter your Email</p>
            </div>
            <p class="ma" style="color: red;visibility: <?php echo $visi; ?>;background-color:white;margin-left: -100px;height: 5px;margin-top: 0px;">Email does not exist</p>
            <div style="margin-top: 30px;background-color:transparent;">
                <input class="pass" style="background-color:transparent;" type="password" name="logpass" required>
                <p class="ph">Enter your password</p>
            </div>
            <p class="ma1" style="color: red;background-color:white;visibility: <?php echo $vis; ?>;margin-left: -100px;height: 5px;margin-top: 0px;">Password is in correct</p>
            <div class="check" style="background-color:white;"><input class="checkp" style="background-color:white;" type="checkbox"><span class="checkp1" style="background-color:white;">show password</span></div>
            <div class="for" style="background-color:white;">
                <input id="register" style="background-color:white;display: inline-block;width: auto;height: 20px;cursor: pointer;" type="button" value="Register"/>
                <input id="forp" style="background-color:white;display: inline-block;width: auto;height: 20px;margin-left: 130px;cursor: pointer;" type="button" value="Forgot"/>
            </div>
            <div style="display: block;width: auto;margin-top: 30px;height: 20px;cursor: pointer;background-color:white;">
                <input id="log1" style="background-color:white;" class="sig" type="submit" name="login" value="submit">
            </div>
            <div style="display:inline;" style="background-color:white;"><a style="background-color:white;display:inline;" href="https://accounts.google.com/o/oauth2/auth/oauthchooseaccount?response_type=code&access_type=online&client_id=34554899605-8eh9rrip3rja1vap434f6pfdr29b7sp7.apps.googleusercontent.com&redirect_uri=http%3A%2F%2Flocalhost%2Fweb%2520project%2F&state&scope=email%20profile&approval_prompt=auto&service=lso&o2v=1&flowName=GeneralOAuthFlow"><img class="glogin" style="background-color:white;" src="./imgs/glogin.png"></a></div>
            </form>
        </div>
    </div>
    <script>
        const email=document.querySelector(".email");
        const eh=document.querySelector(".eh");
        const ma=document.querySelector('.ma');
        const pass=document.querySelector(".pass");
        const ph=document.querySelector(".ph");
        const ma1=document.querySelector('.ma1');
        const register=document.getElementById('register');
        const forgot=document.getElementById('forp');
        const log=document.getElementById('log');
        register.addEventListener('click',() => {
    window.location.href="register.php";
})
forgot.addEventListener('click',() => {
    window.location.href="forgot.php";
})
email.addEventListener('keyup',() => {
        eh.style.fontSize="15px";eh.style.marginTop="-45px";eh.style.position="absolute";eh.style.zIndex="2";eh.style.width="120px";eh.style.backgroundColor="white";
        if(email.value===""){
            eh.style.fontSize="20px";eh.style.marginLeft="70px";eh.style.marginTop="-28px";eh.style.zIndex="1";eh.style.width="auto";eh.style.backgroundColor="white";
        }
});
email.addEventListener('focusin',() => {
    if (email.value!=""){
        eh.style.fontSize="15px";eh.style.marginTop="-45px";eh.style.position="absolute";eh.style.zIndex="2";eh.style.width="120px";eh.style.backgroundColor="white";
    }
    else{
        eh.style.fontSize="20px";eh.style.marginLeft="70px";eh.style.marginTop="-28px";eh.style.zIndex="1";eh.style.width="auto";eh.style.backgroundColor="white";
    }
})
email.addEventListener('focusout',() => {
    if (email.value!=""){
        eh.style.fontSize="15px";eh.style.marginTop="-45px";eh.style.position="absolute";eh.style.zIndex="2";eh.style.width="120px";eh.style.backgroundColor="white";
    }
    else{eh.style.fontSize="20px";eh.style.marginLeft="70px";eh.style.marginTop="-28px";eh.style.zIndex="1";eh.style.width="auto";eh.style.backgroundColor="white";
    }
})
pass.addEventListener('keyup',() => {
        ph.style.fontSize="15px";ph.style.marginTop="-45px";ph.style.position="absolute";ph.style.zIndex="2";ph.style.width="140px";ph.style.backgroundColor="white";
        if(pass.value==""){
            ph.style.fontSize="20px";ph.style.marginLeft="70px";ph.style.marginTop="-28px";ph.style.zIndex="1";ph.style.width="auto";ph.style.backgroundColor="white";
        }
});
pass.addEventListener('focusin',() => {
    if (pass.value!=""){
        ph.style.fontSize="15px";ph.style.marginTop="-45px";ph.style.position="absolute";ph.style.zIndex="2";ph.style.width="140px";ph.style.backgroundColor="white";
    }
    else{
        ph.style.fontSize="20px";ph.style.marginLeft="70px";ph.style.marginTop="-28px";ph.style.zIndex="1";ph.style.width="auto";ph.style.backgroundColor="white";
    }
})
pass.addEventListener('focusout',() => {
    if (pass.value!=""){
        ph.style.fontSize="15px";ph.style.marginTop="-45px";ph.style.position="absolute";ph.style.zIndex="2";ph.style.width="140px";ph.style.backgroundColor="white";
    }
    else{
        ph.style.fontSize="20px";ph.style.marginLeft="70px";ph.style.marginTop="-28px";ph.style.zIndex="1";ph.style.width="auto";ph.style.backgroundColor="white";
    }
})
const checkp1=document.querySelector('.checkp1');
checkp1.addEventListener('click', () => {
    if(checkp.checked){
        pass.setAttribute("type","password");
    }
    else{
        pass.setAttribute("type","text");
    }
})
const checkp=document.querySelector('.checkp');
checkp.addEventListener('change',() => {
    if(checkp.checked){
        pass.setAttribute("type","text");
    }
    else{
        pass.setAttribute("type","password");
    }
})
checkp1.addEventListener('click', function(){
    checkp.checked = !checkp.checked;
})
    </script>
</body>
</html>