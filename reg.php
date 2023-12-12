<?php
include('connection.php');
    if (isset($_POST['login']))
    {
        $username = $_POST['rname'];
        $useremail = $_POST['remail'];
        $password = $_POST['rpass'];
        $cpassword = $_POST['rcpass'];
        if($password == $cpassword){
        $sql = "insert INTO login(name,email, passward) VALUES ('$username','$useremail','$password')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
            header("Location: tubestream.html");
        } 
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo  '<script>
                        window.location.href = "login.html";
                        alert("registeration failed. try agian")
                    </script>';
        }
    }
    else{
        echo '<script>pnotm();</script>';
    }
?>