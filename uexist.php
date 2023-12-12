<?php
include('connection.php');
if(isset($_POST['remail']) && isset($_POST['rname']) && isset($_POST['rpass'])){
$username = $_POST['rname'];
$useremail = $_POST['remail'];
$password = $_POST['rpass'];
$cpassword = $_POST['rcpass'];
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "select * from login where email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
        echo "<script>
            alert('User already exist');
            window.location.href = 'login.php';
        </script>";
} else {
        if($username != "" && $useremail != "" && $password != ""){
        if($password == $cpassword){
            session_start();
            $_SESSION['tname'] = $_POST['rname'];
             $_SESSION['temail']= $_POST['remail'];
             $_SESSION['tpass']= $_POST['rpass'];
            ?>
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
                <div class="loginh" style="box-shadow:0px 2px 3px;background-color:white;">
                <div>
                <img src='./imgs/logo.png' style="width:100px;height:100px;margin-top:20px;">
                <div>
                        <p style="margin-top: 30px;font-size: 25px;"><b>Tube Stream</b></p>
                    </div>
                    <div align="center">
                        <form action="email.php" method="POST">
                            <pre><b style="font-size:20px;"> A OTP will be send to
your email for verification</b></pre>
                        <input type="submit" value="send OTP" name="send" style="margin-top:50px;margin-left:-10px;height: 30px;px;border-radius:6px;width:100px;box-shadow:0px 2px 3px;">
                        </form>
                    </div>
                </div>
                </div>
                </body>
                </html>
            <?php
            }else{
            echo "<script>
                        $('.mat1').css({'visiblity': 'visible');
                        window.location.href = 'register.php';
                    </script>";
        }
    }else{
    echo "<script>
    alert('please fill all the box')
    window.location.href = 'register.php';
</script>";
}
}
$stmt->close();
$conn->close();
}else{
    echo "<script>
    alert('somthing went wrong')
    window.location.href = 'login.php';
</script>";
}
?>