<?php
include('connection.php');
session_start();

include_once "extra/libraries/vendor/autoload.php";

  $google_client = new Google_Client();

  $google_client->setClientId('34554899605-8eh9rrip3rja1vap434f6pfdr29b7sp7.apps.googleusercontent.com'); //Define your ClientID

  $google_client->setClientSecret('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'); //Define your Client Secret Key

  $google_client->setRedirectUri('http://localhost/web%20project/'); //Define your Redirect Uri

  $google_client->addScope('email');

  $google_client->addScope('profile');

  if(isset($_GET["code"]))
  {
   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

   if(!isset($token["error"]))
   {
    $google_client->setAccessToken($token['access_token']);

    $_SESSION['access_token']=$token['access_token'];

    $google_service = new Google_Service_Oauth2($google_client);

    $data = $google_service->userinfo->get();

    $current_datetime = date('Y-m-d H:i:s');

   // print_r($data);
   $_SESSION['uname']=$data['email'];
   $emails=$_SESSION['uname'];
   $sql="SELECT * FROM `login` where `email` = ?";//email exist
   $stmt = $conn->prepare($sql);
$stmt->bind_param("s", $emails);
$stmt->execute();
$result = $stmt->get_result();
$row=mysqli_fetch_assoc($result);
if ($result->num_rows > 0) {
    //registered using google
$sql="SELECT * FROM `login` where `email` = ? and `passward`='google'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $emails);
$stmt->execute();
$result = $stmt->get_result();
$row=mysqli_fetch_assoc($result);
if ($result->num_rows > 0) {
    $_SESSION['id']=$row['id'];
    $_SESSION['uname']=$row['email'];
    $_SESSION['name']=$row['name'];
    $_SESSION['upass']='google';
    $_SESSION['usechannel']=$row['channelname'];
        echo "<script>
            alert('login successful');
            window.location.href = 'tubestream.php';
        </script>";
        exit;
}else{
    echo "<script>
    alert('user exist');
    window.location.href = 'login.php';
</script>";
}
$stmt->close();
}else{
    $_SESSION['name']=$data['given_name']." ".$data['family_name'];
    $name=$_SESSION['name'];
    $sql="INSERT INTO `login`(`name`, `email`, `passward`) VALUES (?,?,'google');";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $emails);
    $stmt->execute();
    if ($stmt === false) {
        unset($_SESSION['name']);
        unset($_SESSION['uname']);
        echo "<script>
            alert('something went wrong');
            window.location.href = 'login.php';
        </script>";
    }
    $stmt->close();
    $sql = "SELECT last_insert_id()";
$stmt = $conn->prepare($sql);
$stmt->execute();
if ($stmt === false) {
    unset($_SESSION['name']);
    unset($_SESSION['uname']);
    echo "<script>
            alert('some thing went wrong');
            window.location.href = 'login.php';
        </script>";
}
$result = $stmt->get_result();
$row = $result->fetch_row();
$_SESSION['id'] = $row[0];
$stmt->close();
$_SESSION['upass']="google";
echo "<script>
            alert('registered successfully');
            window.location.href = 'login.php';
        </script>";
}
   }
  }
?>