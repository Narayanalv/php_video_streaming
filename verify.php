<?php
if(isset($_POST['otp']) && $_POST['send']){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify</title>
</head>
<body>
    <div class="loginh">
    <img src='./imgs/logo.png' style="width:100px;height:100px;margin-top:20px;">
        <div>
            <p style="margin-top: 30px;font-size: 25px;">Tube Stream</p>
        </div>
            <div align="center">
                <form action="" method="POST">
                    <input type="text" name="otp">
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}
if(isset($_POST['otp'])){
    $username=$_SESSION['tname'];
    $useremail=$_SESSION['temail'];
    $password=$_SESSION['tpass'];
    if($_SESSION['otp']==$_POST['otp']){
        $sql = "insert INTO login(name,email, passward) VALUES ('$username','$useremail','$password')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                        alert('Registration successful!')
                        window.location.href = 'login.php';
                    </script>";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
            for($i=0; $i<=10; $i++)
            {
                sleep(5);
            }
            echo  '<script>
                        alert("registeration failed. try agian")
                    </script>';
        }
    }else{
        echo  '<script>
                        alert("wrong otp");
                    </script>';
    }
}
?>