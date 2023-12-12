<?php
session_start();
if(!isset($_SESSION['id'])){
    echo "<script>
            window.location.href = 'tubestream.php';
        </script>";
}else{
    unset($_SESSION['id']);
    unset($_SESSION['uname']);
    session_destroy();
    echo "<script>
    window.location.href = 'tubestream.php';
</script>";
}
?>