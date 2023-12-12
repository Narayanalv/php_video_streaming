<?php
include("connection.php");
session_start();
if(isset($_GET['textbox'])){
    $search=$_GET['textbox'];
    $search=explode(' ',$search);
    $vid=array();
    $id=array();
    $cna=array();
    $des=array();
    $imges=array();
    $viname=array();
    $view=array();
    $k=0;
    for($j=0;$j<sizeof($search);$j++){
    $str=$search[$j];
    $sql="SELECT channel.profile, main.uid, main.videoname, main.description, main.view, main.cname, main.id FROM main join channel ON main.uid = channel.lid WHERE `description` LIKE '%$str%'";
    $res=$conn->query($sql);
    if($res->num_rows>0){
        while ($row = mysqli_fetch_assoc($res)){
            $ii=$row['id'];
            if(!in_array($ii,$vid) || count($vid)==0){
                $vid[]=$row['id'];
                $id[]=$row['uid'];
                $cna[]=$row['cname'];
                $viname[]=$row['videoname'];
                $des[]=$row['description'];
                $view[]=$row['view'];
                $img=$row['profile'];
                $imgs=base64_encode($img);
                $imges[]=$imgs;
                $k=+1;
            }
            unset($ii);
        }
    }
    }
    $sql1 = "SELECT channel.profile, main.uid, main.videoname, main.description, main.view, main.cname, main.id FROM main JOIN channel ON main.uid = channel.lid";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $ii = $row['id'];
            if (!in_array($ii, $vid) || count($vid) == 0) {
                $viname[] = $row['videoname'];
                $vid[]=$row['id'];
                $id[] = $row['uid'];
                $cna[] = $row['cname'];
                $des[] = $row['description'];
                $view[] = $row['view'];
                $img = $row['profile'];
                $imgs = base64_encode($img);
                $imges[] = $imgs;
                $k++;
            }
            unset($ii);
        }
    }    
    $images=json_encode($imges);
    $iid=json_encode($id);
    $video=json_encode($viname);
    $desc=json_encode($des);
    $views=json_encode($view);
    $names=json_encode($cna);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
        <script src="jquery-3.7.0.min.js"></script>
        <style>
      @media (min-width:768px){
        .videoh{
        }
      }
        .mylist, .login, .create{width:100%;height:100%;}
::-webkit-scrollbar {
    width: 1px;
}

::-webkit-scrollbar-thumb {
    background-color: #888;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #555;
}

::-webkit-scrollbar-track {
    background-color: #f1f1f1;
}
    </style>
    </head>
    <body onload="video()">
    <div>
    <div class="header">
        <div class="logoh">
        <div class="mh">
            <img class="menuh" src="./imgs/menu.png">
        </div>
            <img class="logo" src="./imgs/logo.png" alt="logo">
        </div>
        <div class="search">
            <form action="search.php" method="GET" style="background:transparent;">
            <img class="seaicon" src="./imgs/search1.png" alt="search">
            <input class="textbox" type="text" placeholder="search" name="textbox" id="textbox">
            </form>
        </div>
        <div class="mich">
            <img class="mic" src="./imgs/mic.png" alt="mic" onclick="speech()">
        </div>
        <div style="cursor: pointer;">
        <?php
        $image1='./imgs/sign.png';
        $text='Sign In';
        $hid="hidden";
        $href="login.php";
    if(isset($_SESSION['id']) && $_SESSION['id']!=''){
        $id=$_SESSION['id'];
    $sql = "SELECT `profile` FROM channel WHERE lid = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $image_data = $row['profile'];
        $data=base64_encode($image_data);
        $image1 = "data:image/jpeg;base64,$data";
        $text='Sign Out';
        $hid="visible";
        $href="logout.php";
    }else{
        $text='Sign in';
        $hid="hidden";
        $image1="./imgs/nop.png";
    }
}
        ?>
        <img style="vertical-align:middle;visibility:<?php echo $hid ?>;" class="signicon" src="<?php echo $image1 ?>"><a href="<?php echo $href ?>" class="sign"><span class="signtext"><?php echo $text; ?></span></a>
        </div>
    </div>
    <div id="m1">
    <form>
        <div class="mark m11">
            <div class="home hom">
                <img id="img" src="./imgs/home.png" alt="home">
                <span class="text">Home</span>
            </div>
        </div>
        </form>
        <form>
        <div class="mark">
            <div class="ac home">
                <img id="img"class="img" name="Shorts" src="./imgs/sign.png">
                <span class="text">Account</span>
            </div>
        </div>
        </form>
        <form>
        <div class="mark">
            <div class="home sub" name="">
                <img id="img" class="img" name="follow" src="./imgs/subscription.png">
                <span class="text">Following</span>
            </div>
        </div>
        </form>
        <form action="" method="POST">
        <div class="mark">
            <div class="home lib">
                <img id="img" class="img" name="Library" src="./imgs/library.png">
                <span class="text">Library</span>
            </div>
        </div>
        </form>
    </div>
    <div class="videoh">
    </div>
    <div class="acc">
        <div class="login">
        <center><a href="login.php" style="vertical-align:middle;text-align: center;"><img style="vertical-align:middle;text-align: center;" src="./imgs/sign.png"><p>Sign in</p></a><div></center></div>
        <div class="create"><center><a href="ccreate.php" style="cursor: pointer;"><h1>create your channel</h1></a></center></div>
        <div class="mylist">mylist tag
        <div style="width: 100%;height: 200px;"></div>
        <div style="width: 49.74%;height: 100px;display: inline-block;text-align: center;"><h4 class="inblock">videos</h4>
            <div id="videoContainer" style="overflow-y: scroll;"></div>
        </div>
        <!--<div style="width: 49.71%;height: 65%;display: inline-block;text-align: center;overflow-y: scroll;"><h4 class="inblock">Playlist</h4></div>
        <div></div>-->
        </div>
    </div>
</div>
<script>
        function speech(){
    var speech = true;
    window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const recognition = new SpeechRecognition();
    recognition.interimResults = true;
    const words = document.querySelector('.search');
    words.appendChild(textbox);
    recognition.addEventListener('result', e => {
        const transcript = Array.from(e.results)
            .map(result => result[0])
            .map(result => result.transcript)
            .join('')
        document.getElementById("textbox").value = transcript;
        console.log(transcript);
    });
    if (speech == true) {
        recognition.start();
        recognition.addEventListener('end');
    }
}
const mh=document.querySelector('.mh');
var nm=document.querySelector('.nm');
var vh=document.querySelector('.vh');
var videohover=document.querySelector('.videohover');
const hom=document.querySelector('.hom');
const ac=document.querySelector('.ac');
const sub=document.querySelector('.sub');
const lib=document.querySelector('.lib');
const videoh=document.querySelector('.videoh');
const acc=document.querySelector('.acc');
const create=document.querySelector('.create');
const mylist=document.querySelector('.mylist');
hom.addEventListener('click', () => {
  $('.login').css('display','none');
    videoh.style.display='flex';
    ac.style.backgroundColor=" rgb(184, 184, 184)";
    hom.style.backgroundColor="rgb(21, 115, 197)";
    lib.style.backgroundColor=" rgb(184, 184, 184)";
    sub.style.backgroundColor=" rgb(184, 184, 184)";
})
$('.sub').click(function() {
      hom.style.backgroundColor=" rgb(184, 184, 184)";
      sub.style.backgroundColor="rgb(21, 115, 197)";
      ac.style.backgroundColor=" rgb(184, 184, 184)";
      lib.style.backgroundColor=" rgb(184, 184, 184)";
      $.ajax({
        url: 'acc.php',
        type: 'POST',
        data: { check: 'check' },
        success: function(response) {
          // Handle the response from PHP function
          if(response ==="channel"){
            window.location.href = 'followers.php';
          }else if(response === "nochannel"){
            window.location.href = 'followers.php';
          }
          else if(response === "login"){
            alert('login');
          }
        }
      });
    });
    $('.ac').click(function() {
      videoh.style.display='none';
      acc.style.display='inline-block';
      hom.style.backgroundColor=" rgb(184, 184, 184)";
      ac.style.backgroundColor="rgb(21, 115, 197)";
      lib.style.backgroundColor=" rgb(184, 184, 184)";
      sub.style.backgroundColor=" rgb(184, 184, 184)";
      $.ajax({
        url: 'acc.php',
        type: 'POST',
        data: { check: 'check' },
        success: function(response) {
          console.log(response)
          // Handle the response from PHP function
          if(response ==="channel"){
            window.location.href = 'myac.php';
          }else if(response === "nochannel"){
            window.location.href = 'ccreate.php';
          }
          else if(response === "login"){
            $('.create').css('display','none');
            $('.login').css('display','block');
            $('.mylist').css('display','none');
            alert('login');
          }
        }
      });
    });
    $('.lib').click(function() {
      videoh.style.display='none';
      acc.style.display='inline-block';
      hom.style.backgroundColor=" rgb(184, 184, 184)";
      lib.style.backgroundColor="rgb(21, 115, 197)";
      ac.style.backgroundColor=" rgb(184, 184, 184)";
      sub.style.backgroundColor=" rgb(184, 184, 184)";
      $.ajax({
        url: 'acc.php',
        type: 'POST',
        data: { check: 'check' },
        success: function(response) {
          console.log(response)
          // Handle the response from PHP function
          if(response ==="channel"){
            window.location.href = 'library.php';
          }else if(response === "nochannel"){
            window.location.href = 'library.php';
          }
          else if(response === "login"){
            $('.create').css('display','none');
            $('.login').css('display','block');
            $('.mylist').css('display','none');
            alert('login');
          }
        }
      });
    });
$('.ac').click(function() {
      videoh.style.display='none';
      acc.style.display='inline-block';
      hom.style.backgroundColor=" rgb(184, 184, 184)";
      ac.style.backgroundColor="rgb(21, 115, 197)";
      lib.style.backgroundColor=" rgb(184, 184, 184)";
      sub.style.backgroundColor=" rgb(184, 184, 184)";
      $.ajax({
        url: 'acc.php',
        type: 'POST',
        data: { check: 'check' },
        success: function(response) {
          console.log(response)
          // Handle the response from PHP function
          if(response ==="channel"){
            window.location.href = 'myac.php';
          }else if(response === "nochannel"){
            $('.create').css('display','block');
            $('.mylist').css('display','none');
            $('.login').css('display','none');
          }
          else if(response === "login"){
            $('.create').css('display','none');
            $('.login').css('display','block');
            $('.mylist').css('display','none');
          }
            alert(response);
        }
      });
    });
    mh.addEventListener('click',() =>{
var allmen=document.getElementsByClassName('home');
var ele=document.getElementsByClassName('text');
for(var i=0; i<ele.length;i++){
if(ele[i].style.display==='inline' || ele[i].style.display===''){
    allmen[i].style.transition='.5s';
    allmen[i].style.width='40px';
    m1.style.transition='.5s';
    m1.style.width='80px';
    ele[i].style.display='none';
    videoh.style.filter="blur(0px)";
}else{
for(var i=0; i<ele.length;i++){
    allmen[i].style.transition='.5s';
    allmen[i].style.width='150px';
    ele[i].style.display='inline';
    m1.style.transition='.5s';
    m1.style.width='180px';
    //videoh.style.filter="blur(5px)";
}
}
}
})
    var des;
    var names;
    var j=0;
    var k=8;
    var id;
    var imags;
    var name;
    var viw;
    function video(){
      //var names=JSON.parse(name);
      //var des=JSON.parse(des);
      k=<?php echo $k ?>;
      imags='<?php echo $images ?>';
      des='<?php echo $desc ?>';
      names='<?php echo $video ?>';
      id='<?php echo $iid ?>';
      name='<?php echo $names ?>';
      viw='<?php echo $views ?>';
      var imagess=JSON.parse(imags);
      var descrip=JSON.parse(des);
      var videon=JSON.parse(names);
      var iid=JSON.parse(id);
      var cnames=JSON.parse(name);
      var vview=JSON.parse(viw);
          for (var i = j; i < k; i++){
            if(videon[i]!=null){
            var ancher1=document.createElement('a');
            var ancher=document.createElement('a');
            var holder=document.createElement('div');
            var videoElement = document.createElement('video');
            var description = document.createElement('div');
            var logodesh=document.createElement('div');
            var imgs=document.createElement('img');
            var imga=imagess[i]
            if(vview[i]==null){
                vview[i]='';
            }
            if(descrip[i].length >= 25){
                var dis=descrip[i].substr(0,25)+'......';
            }else{
                var dis=descrip[i]
            }
            holder.style.boxShadow='black 1px 3px 10px 1px';
            holder.style.width='300px';
            holder.style.marginLeft='10px';
            holder.style.marginTop='10px';
            holder.style.height='215px';
            holder.style.display='inline-block';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
            videoElement.src = './src/'+videon[i];
            ancher.href="viewv.php?src="+videoElement.src;
            videoElement.controls = false;
            videoElement.className = 'video-class-'+i+" vidh";
            videoElement.style.width='100%';
            videoElement.style.zIndex='10';
            videoElement.style.height='80%';
            videoElement.style.borderRadius='20px';
            imgs.style.width='15%';
            imgs.style.height='100%';
            imgs.style.borderRadius="60px";
            imgs.style.zIndex="100";
            imgs.name=iid[i];
            ancher1.href="chome.php?cname="+iid[i];
            imgs.src='data:image/png;base64,'+imga;
            logodesh.style.width='100%';
            logodesh.style.height='18%';
            logodesh.style.borderRadius="20px";
            imgs.style.verticalAlign='top';
            description.style.width="80%";
            description.style.display="inline-block";
            description.style.verticalAlign='top';
            description.style.backgroundColor='inherit';
            description.innerHTML=dis+'<br>'+cnames[i]+'  views '+vview[i];
            logodesh.style.backgroundColor='inherit';
            description.title=descrip[i];
            videoh.appendChild(holder);
            holder.appendChild(ancher);
            ancher.appendChild(videoElement);
            holder.appendChild(logodesh);
            logodesh.appendChild(ancher1);
            ancher1.appendChild(imgs);
            logodesh.appendChild(description);
            videoElement.addEventListener('mouseleave', handleMouseLeave);
            videoElement.addEventListener('mouseenter', handleMouseEnter);
            videoElement.addEventListener('click', handleClick);
            imgs.addEventListener('click',clickedlogo)
          }
        }
        function clickedlogo(event){
            var imgs=event.target;
            var uidd=imgs.name;
            var url='chome.php?cname='+encodeURIComponent(uidd);
            window.location.href = ('_blank',url);
        }
        function handleClick(event) {
  var videoElement = event.target;
  var videoSrc = videoElement.src;
  var videoId = videoElement.getAttribute('data-video-id'); // Get the video ID from the data attribute
  var videoDescription = videoElement.getAttribute('data-video-description'); // Get the video description from the data attribute

  // Construct the URL with query parameters for the next page
  var url = 'viewv.php?src=' + encodeURIComponent(videoSrc);
  
  // Navigate to the new page
  window.location.href = ('_blank',url);
}
          function handleFocus(event) {
            var videoElement = event.target;
            videoElement.play();
            //videoElement.controls = true;
          }
          function handleMouseEnter(event) {
            var videoElement = event.target;
             videoElement.play();
             //videoElement.controls = true;
          }
          function handleMouseLeave(event) {
            var videoElement = event.target;
            videoElement.pause();
            //videoElement.controls = false;
          }
  }
</script>
    </body>
    </html>
<?php
}
?>