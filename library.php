<?php
include('connection.php');
session_start();
if (isset($_SESSION['id']) && $_SESSION['id'] != '') {
  $text='Sign Out';
    $href = "logout.php";
    $hid="visible";
} else {
    $image1='./imgs/sign.png';
  $text='Sign In';
    $href = "login.php";
    $hid="hidden";
}
if(isset($_SESSION['id'])){
$id=$_SESSION['id'];
$follled="follow";
$folvis="visible";
if(isset($_SESSION['id'])!=''){
$uid=$_SESSION['id'];
}
$sql1="SELECT `likev`,`save`,`history` FROM `login` WHERE id=$id";
$resu=$conn->query($sql1);
$ro=$resu->fetch_assoc();
if($resu->num_rows > 0){
    $likev=null;
    $save=null;
    $his=null;
    $video2s='';
    $desc2='';
    $views2='';
    $chname2='';
    $images2='';
    $iid12='';
    $images22 ='';
    $i=0;
    if($ro['likev']!=null && $ro['likev']!=''){
    $likev=$ro['likev'];
    $li=explode(" ",$likev);
    $rowvideo2 = array ();
    $rowddesc2 = array ();
    $view22=array();
    $rowuid2=array ();
    $cname2=array();
    $images22=array();
    $imges2=array();
    if($likev!=null && $likev!=''){
        $ii=0;
    for($i = 0; $i < count($li); $i++){
        $sql="SELECT channel.profile, main.uid, main.videoname, main.description, main.view, main.cname FROM main JOIN channel ON main.uid = channel.lid WHERE main.id=$li[$i]";
        $result2=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result2) > 0)
        if ($row = mysqli_fetch_assoc($result2)){
            $rowvideo2[$ii]=$row['videoname'];
            $rowuid2[$ii]=$row['uid'];
            $rowddesc2[$ii]=$row['description'];
            $view22[$ii]=$row['view'];
            $cname2[$ii]=$row['cname'];
            $img2=$row['profile'];
            $imgs1=base64_encode($img2);
            $imges2[$ii]=$imgs1;
            $img2='';
            $ii=$ii+1;
        }
    }
    $video2s=json_encode($rowvideo2);
    $desc2=json_encode($rowddesc2);
    $views2=json_encode($view22);
    $chname2=json_encode($cname2);
    $images22=json_encode($imges2);
    $iid12=json_encode($rowuid2);
}
    }
    $video1s='';
    $desc1='';
    $views1='';
    $chname='';
    $images11='';
    $iid1='';
    $j=0;
    if($ro['save']!=null && $ro['save']!=''){
    $save=$ro['save'];
    $sa=explode(' ',$save);
    $rowvideo1 = array ();
    $rowddesc1 = array ();
    $view1=array();
    $rowuid1=array ();
    $cname1=array();
    $imges1=array();
    if($save!=null && $save!=''){
    for($j = 0; $j < count($sa); $j++){
        $sql="SELECT channel.profile, main.uid, main.videoname, main.description, main.view, main.cname FROM main JOIN channel ON main.uid = channel.lid WHERE main.id=$sa[$j]";
        $result2=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result2) > 0)
        if ($row = mysqli_fetch_assoc($result2)){
            $rowvideo1[$j]=$row['videoname'];
            $rowuid1[$j]=$row['uid'];
            $rowddesc1[$j]=$row['description'];
            $view1[$j]=$row['view'];
            $cname1[$j]=$row['cname'];
            $img1=$row['profile'];
            $imgs1=base64_encode($img1);
            $imges1[$j]=$imgs1;
            $img1='';
        }
    }
    $video1s=json_encode($rowvideo1);
    $desc1=json_encode($rowddesc1);
    $views1=json_encode($view1);
    $chname=json_encode($cname1);
    $images11=json_encode($imges1);
    $iid1=json_encode($rowuid1);
}
}
if($ro['history']!=null && $ro['history']!=''){
    $his=$ro['history'];
    $hi=explode(" ",$his);
    $rowvideo3 = array ();
    $rowddesc3 = array ();
    $view33=array();
    $rowuid3=array ();
    $cname3=array();
    $images33=array();
    $imges3=array();
    if($his!=null && $his!=''){
        $ik=0;
    for($k = 0; $k < count($hi); $k++){
        $sql="SELECT channel.profile, main.uid, main.videoname, main.description, main.view, main.cname FROM main JOIN channel ON main.uid = channel.lid WHERE main.id=$hi[$k]";
        $result2=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result2) > 0)
        if ($row = mysqli_fetch_assoc($result2)){
            $rowvideo3[$ik]=$row['videoname'];
            $rowuid3[$ik]=$row['uid'];
            $rowddesc3[$ik]=$row['description'];
            $view33[$ik]=$row['view'];
            $cname3[$ik]=$row['cname'];
            $img3=$row['profile'];
            $imgs3=base64_encode($img3);
            $imges3[$ik]=$imgs3;
            $img3='';
            $ik=$ik+1;
        }
    }
    $video3s=json_encode($rowvideo3);
    $desc3=json_encode($rowddesc3);
    $views3=json_encode($view33);
    $chname3=json_encode($cname3);
    $images33=json_encode($imges3);
    $iid13=json_encode($rowuid3);
}
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='icon' type='image/x-icon' href='./imgs/logo.png'/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Account</title>
    <script src="jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        *{background-color:#e6dff7;}
        @media only screen and (max-width: 600px) {
  .videohplder div {
    width:200px;
  }
  video{width:100%;}
}
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
.lib1, .lib2{z-index: 1000;float:right;position:fixed;right:0%;}
.savev:hover{background-color: white;}
.history:hover{background-color: white;}
.like:hover{background-color: white;}
    </style>
</head>
<body style="background-color:antiquewhite;" onload="video()">
<div>
    <div class="header">
        <div class="logoh">
        <div class="mh">
            <img class="menuh" src="./imgs/menu.png">
        </div>
            <a href="tubestream.php"><img class="logo" src="./imgs/logo.png" alt="logo"></a>
        </div>
        <div class="search">
            <form action="search.php" method="GET" style="background:transparent;width:auto;height:auto;display:inline;">
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
        $image1="./imgs/nop.png";
    }
}
        ?>
        <img style="vertical-align:middle;visibility:<?php echo $hid ?>;" class="signicon" src="<?php echo $image1 ?>"><a href="<?php echo $href ?>" class="sign"><span class="signtext"><?php echo $text; ?></span></a>
        </div>
    </div>
    <div id="m1">
        <div class="mark m11">
            <div class="home hom" style="background-color:rgb(184, 184, 184);">
                <img id="img" src="./imgs/home.png" alt="home">
                <span class="text">Home</span>
            </div>
        </div>
        <div class="mark">
            <div class="ac home">
                <img id="img"class="img" name="Shorts" src="./imgs/sign.png">
                <span class="text">Account</span>
            </div>
        </div>
        <div class="mark">
            <div class="home sub">
                <img id="img" class="img" name="follow" src="./imgs/subscription.png">
                <span class="text">Following</span>
            </div>
        </div>
        <div class="mark">
            <div class="home lib" style="background-color:rgb(21, 115, 197);">
                <img id="img" class="img" name="Library" src="./imgs/library.png">
                <span class="text">Library</span>
            </div>
        </div>
    </div>
    <div class="videoh">
    </div>
    <div class="lib2" style="margin-top:120px;background-color:transparent;width:100px;height:210px;"><div class="lib1" style="visibility:hidden;margin-top:20px;padding-left:10px;background-color:transparent;padding-top:10px;padding-bottom:10px;z-index:1001;position:absolute;">
        <center><div class="history" style="border-radius:20px;vertical-align:middle;width:50px;height:50px;"><img src="./imgs/his.png" alt="" title="History" style="width:100%;height:100%;background-color:transparent;"></div></center>
        <center><div class="like" style="vertical-align:middle;border-radius:10px;width:40px;height:40px;"><img src="./imgs/like.png" alt="" title="Saved Videos" style="width:100%;height:100%;background-color:transparent;"></div></center>
        <center><div class="savev" id="sav" style="vertical-align:middle;width:45px;height:45px;border-radius:20px;"><img src="./imgs/save.png" alt="" title="Liked Videos" style="width:100%;height:100%;background-color:transparent;"></div></center>
    </div></div>
    <div class="acc">
        <div class="login">
        <center><a href="login.php" style="vertical-align:middle;text-align: center;"><img style="vertical-align:middle;text-align: center;" src="./imgs/sign.png"><p>Sign in</p></a><div></center></div>
        <div class="create"><center><a href="ccreate.php" style="cursor: pointer;"><h1>create your channel</h1></a></center></div>
        <div class="mylist">mylist tag
        <div style="width: 100%;height: 200px;"></div>
        <div style="width: 49.74%;height: 100px;display: inline-block;text-align: center;"><h4 class="inblock">videos</h4>
            <div id="videoContainer" style="overflow-y: scroll;"></div>
        </div>
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
const lib2=document.querySelector('.lib2');
const lib1=document.querySelector('.lib1');
lib2.addEventListener('mouseenter',()=>{
    lib1.style.visibility="visible";
    lib1.style.opacity='0.5'
})
lib2.addEventListener('mouseleave',()=>{
    lib1.style.visibility="hidden";
})
lib1.addEventListener('mouseenter',()=>{
    lib1.style.visibility="visible";
    lib1.style.opacity='1';
})
lib1.addEventListener('mouseleave',()=>{
    lib1.style.opacity='0.5';
})
    //const videoholder=document.querySelector('.videoholder');
    const like=document.querySelector('.like');
const save=document.querySelector('.save');
const history=document.querySelector('.history');
const sav=document.getElementById('sav');
const savev=document.querySelector('.savev');
const logo=document.querySelector('.logo');
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
$('.hom').click(function (e) { 
    window.location.href = 'tubestream.php';
});
$('.sub').click(function() {
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
            window.location.href = 'myac.php';
          }
          else if(response === "login"){
            $('.create').css('display','none');
            $('.login').css('display','block');
            $('.mylist').css('display','none');
          }
        }
      });
    });
    $('.lib').click(function() {
        window.location.href = 'library.php';
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
    videoh.style.filter="blur(5px)";
}
}
}
})
var hedding="video";
var des;
var names;
function video(){
    function removeElement(element) {
    if (element && element.parentNode) {
        element.parentNode.removeChild(element);
    }
}
function removeAllElements() {
    while (videoh.firstChild) {
        removeElement(videoh.firstChild);
    }
}
removeAllElements();
//hedding='History';
//namehold.innerHTML=hedding;
    var li='<?php echo $his ?>';
    if(li!=null && li!=''){
        var k=<?php echo $ik ?>;
        des123='<?php echo $desc3 ?>';
        names123='<?php echo $video3s ?>';
        viw123='<?php echo $views3 ?>';
        cname123='<?php echo $chname3 ?>';
        img123='<?php echo $images33 ?>';
        id123='<?php echo $iid13 ?>';
        var descrip=JSON.parse(des123);
        var videon=JSON.parse(names123);
        var vview=JSON.parse(viw123);
        var ccname=JSON.parse(cname123);
        var imges1=JSON.parse(img123);
        var id11=JSON.parse(id123);
        var j=0;
        for (var i = 0; i < k; i++){
            if(videon[i]!=null){
            var ancher1=document.createElement('a');
            var ancher=document.createElement('a');
            var holder=document.createElement('div');
            var videoElement = document.createElement('video');
            var description = document.createElement('div');
            var logodesh=document.createElement('div');
            var imgs=document.createElement('img');
            var imga=imges1[i];
            if(vview[i]==null){
                vview[i]='';
            }
            if(descrip[i].length >= 20){
                var dis=descrip[i].substr(0,20)+'......';
            }else{
                var dis=descrip[i];
            }
            holder.style.boxShadow='black 1px 3px 10px 1px';
            holder.style.width='300px';
            holder.style.height='215px';
            holder.style.display='inline-block';
            holder.style.marginTop='10px';
            holder.style.marginLeft='10px';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
            holder.style.boxShadow='box-shadow:0 5px 40px rgba(0,0,0,.30)';
            videoElement.src = './src/'+videon[i];
            ancher.href="viewv.php?src="+videoElement.src;
            videoElement.controls = false;
            videoElement.style.borderRadius='20px';
            videoElement.className = 'video-class-'+i+" vidh";
            videoElement.style.width='99%';
            videoElement.style.zIndex='10';
            videoElement.style.height='80%';
            imgs.style.width='15%';
            imgs.style.height='100%';
            imgs.style.borderRadius="60px";
            imgs.style.zIndex="100";
            imgs.name=id11[i];
            ancher1.href="chome.php?cname="+id11[i];
            imgs.src='data:image/png;base64,'+imga;
            logodesh.style.width='100%';
            logodesh.style.height='18%';
            logodesh.style.borderRadius="20px";
            description.style.display="inline-block";
            description.style.backgroundColor='inherit';
            logodesh.style.backgroundColor='inherit';
            imgs.style.verticalAlign='top';
            description.style.width="80%";
            logodesh.style.backgroundColor='inherit';
            description.style.display="inline-block";
            description.style.verticalAlign='top';
            description.title=descrip[i];
            description.innerHTML=dis+'<br>'+ccname[i]+'  views '+vview[i];
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
          function clickedlogo(event){
            var imgs=event.target;
            var uidd=imgs.name;
            var url='chome.php?cname='+encodeURIComponent(uidd);
            window.location.href = ('_blank',url);
        }
        function handleClick(event) {
  var videoElement = event.target;
  var videoSrc = videoElement.src;
  var videoId = videoElement.getAttribute('data-video-id');
  var videoDescription = videoElement.getAttribute('data-video-description');
  var url = 'viewv.php?src=' + encodeURIComponent(videoSrc);
  window.location.href = ('_blank',url);
}
          function handleFocus(event) {
            var videoElement = event.target;
            videoElement.play();
          }
          function handleMouseEnter(event) {
            var videoElement = event.target;
             videoElement.play();
          }
          function handleMouseLeave(event) {
            var videoElement = event.target;
            videoElement.pause();
          }
    }
}
var des1;
var names1;
var viw1;
var cname1;
var img11;
var id1;
savev.addEventListener('click',() =>{
    function removeElement(element) {
    if (element && element.parentNode) {
        element.parentNode.removeChild(element);
    }
}
function removeAllElement() {
    while (videoh.firstChild) {
        removeElement(videoh.firstChild);
    }
}
removeAllElement();
//hedding='Saved Videos';
//namehold.innerHTML=hedding;
    var save='<?php echo $save ?>';
    if(save!=null && save!=''){
        var k=<?php echo $j ?>;
        des1='<?php echo $desc1 ?>';
        names1='<?php echo $video1s ?>';
        viw1='<?php echo $views1 ?>';
        cname1='<?php echo $chname ?>';
        img11='<?php echo $images11 ?>';
        id1='<?php echo $iid1 ?>';
        var descrip=JSON.parse(des1);
        var videon=JSON.parse(names1);
        var vview=JSON.parse(viw1);
        var ccname=JSON.parse(cname1);
        var imges1=JSON.parse(img11);
        var id11=JSON.parse(id1);
        var j=0;
        for (var i = j; i < k; i++){
            if(videon[i]!=null){
            var ancher1=document.createElement('a');
            var ancher=document.createElement('a');
            var holder=document.createElement('div');
            var videoElement = document.createElement('video');
            var description = document.createElement('div');
            var logodesh=document.createElement('div');
            var imgs=document.createElement('img');
            var imga=imges1[i]
            if(vview[i]==null){
                vview[i]='';
            }
            if(descrip[i].length >= 30){
                var dis=descrip[i].substr(0,30)+'......';
            }else{
                var dis=descrip[i];
            }
            holder.style.boxShadow='0px 3px 1px 1px black';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
            holder.style.marginTop='10px';
            holder.style.width='24%';
            holder.style.height='35%';
            holder.style.display='inline-block';
            holder.style.boxShadow='box-shadow:0 5px 40px rgba(0,0,0,.30)';
            videoElement.src = './src/'+videon[i];
            ancher.href="viewv.php?src="+videoElement.src;
            videoElement.controls = false;
            videoElement.className = 'video-class-'+i+" vidh";
            videoElement.style.width='99%';
            videoElement.style.zIndex='10';
            videoElement.style.height='80%';
            imgs.style.width='15%';
            imgs.style.height='100%';
            imgs.style.borderRadius="60px";
            imgs.style.zIndex="100";
            imgs.name=id11[i];
            ancher1.href="chome.php?cname="+id11[i];
            imgs.src='data:image/png;base64,'+imga;
            logodesh.style.width='100%';
            logodesh.style.height='18%';
            imgs.style.verticalAlign='top';
            description.style.width="80%";
            description.style.display="inline-block";
            description.style.verticalAlign='top';
            description.style.backgroundColor='#636363';
            description.style.color='white';
            description.innerHTML=descrip[i]+'<br>'+ccname[i]+'  views '+vview[i];
            logodesh.style.backgroundColor='#636363';
            logodesh.style.borderRadius="20px";
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
          function clickedlogo(event){
            var imgs=event.target;
            var uidd=imgs.name;
            var url='chome.php?cname='+encodeURIComponent(uidd);
            window.location.href = ('_blank',url);
        }
        function handleClick(event) {
  var videoElement = event.target;
  var videoSrc = videoElement.src;
  var videoId = videoElement.getAttribute('data-video-id');
  var videoDescription = videoElement.getAttribute('data-video-description');
  var url = 'viewv.php?src=' + encodeURIComponent(videoSrc);
  window.location.href = ('_blank',url);
}
          function handleFocus(event) {
            var videoElement = event.target;
            videoElement.play();
          }
          function handleMouseEnter(event) {
            var videoElement = event.target;
             videoElement.play();
          }
          function handleMouseLeave(event) {
            var videoElement = event.target;
            videoElement.pause();
          }
    }
}
var no=sav.childElementCount;
if (no == 0){
    $(".videoh").html('no video')
    sav.style.textAlign="center";
    sav.style.fontSize='30px';
    }
});
var des12;
var names12;
var viw12;
var cname12;
var img12;
var id12;
like.addEventListener('click',() =>{
function removeAllElement() {
    while (videoh.firstChild) {
        removeElement(videoh.firstChild);
    }
}
removeAllElement();
//hedding='Liked Videos';
//namehold.innerHTML=hedding;
    var li='<?php echo $likev ?>';
    if(li!=null && li!=''){
        var k=<?php echo $i ?>;
        des12='<?php echo $desc2 ?>';
        names12='<?php echo $video2s ?>';
        viw12='<?php echo $views2 ?>';
        cname12='<?php echo $chname2 ?>';
        img12='<?php echo $images22 ?>';
        id12='<?php echo $iid12 ?>';
        var descrip=JSON.parse(des12);
        var videon=JSON.parse(names12);
        var vview=JSON.parse(viw12);
        var ccname=JSON.parse(cname12);
        var imges1=JSON.parse(img12);
        var id11=JSON.parse(id12);
        var j=0;
        for (var i = j; i < k; i++){
            if(videon[i]!=null){
            var ancher1=document.createElement('a');
            var ancher=document.createElement('a');
            var holder=document.createElement('div');
            var videoElement = document.createElement('video');
            var description = document.createElement('div');
            var logodesh=document.createElement('div');
            var imgs=document.createElement('img');
            var imga=imges1[i]
            if(vview[i]==null){
                vview[i]='';
            }
            if(descrip[i].length >= 30){
                var dis=descrip[i].substr(0,30)+'......';
            }else{
                var dis=descrip[i];
            }
            holder.style.boxShadow='0px 3px 1px 1px black';
            holder.style.width='24%';
            holder.style.height='35%';
            holder.style.display='inline-block';
            holder.style.marginTop='10px';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
            holder.style.boxShadow='box-shadow:0 5px 40px rgba(0,0,0,.30)';
            videoElement.src = './src/'+videon[i];
            ancher.href="viewv.php?src="+videoElement.src;
            videoElement.controls = false;
            videoElement.style.borderRadius='20px';
            videoElement.className = 'video-class-'+i+" vidh";
            videoElement.style.width='99%';
            videoElement.style.zIndex='10';
            videoElement.style.height='80%';
            imgs.style.width='15%';
            imgs.style.height='100%';
            imgs.style.borderRadius="60px";
            imgs.style.zIndex="100";
            imgs.name=id11[i];
            ancher1.href="chome.php?cname="+id11[i];
            imgs.src='data:image/png;base64,'+imga;
            logodesh.style.width='100%';
            logodesh.style.height='18%';
            logodesh.style.borderRadius="20px";
            description.style.display="inline-block";
            description.style.backgroundColor='#636363';
            logodesh.style.backgroundColor='#636363';
            description.style.color='white';
            imgs.style.verticalAlign='top';
            description.style.width="80%";
            logodesh.style.backgroundColor='#636363';
            description.style.display="inline-block";
            description.style.verticalAlign='top';
            description.title=descrip[i];
            description.innerHTML=dis+'<br>'+ccname[i]+'  views '+vview[i];
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
          function clickedlogo(event){
            var imgs=event.target;
            var uidd=imgs.name;
            var url='chome.php?cname='+encodeURIComponent(uidd);
            window.location.href = ('_blank',url);
        }
        function handleClick(event) {
  var videoElement = event.target;
  var videoSrc = videoElement.src;
  var videoId = videoElement.getAttribute('data-video-id');
  var videoDescription = videoElement.getAttribute('data-video-description');
  var url = 'viewv.php?src=' + encodeURIComponent(videoSrc);
  window.location.href = ('_blank',url);
}
          function handleFocus(event) {
            var videoElement = event.target;
            videoElement.play();
          }
          function handleMouseEnter(event) {
            var videoElement = event.target;
             videoElement.play();
          }
          function handleMouseLeave(event) {
            var videoElement = event.target;
            videoElement.pause();
          }
    }
}
var no=like.childElementCount;
if (no === 0){
    $(".videoh").html('no video')
    like.style.textAlign="center";
    like.style.fontSize='30px';    
    }
});
function checkScroll() {
    const scrollableHeight = videoh.documentElement.scrollHeight - videoh.innerHeight;
    const currentPosition = videoh.scrollY;
    console.log('end');
    const threshold = 100;
    if (scrollableHeight - currentPosition <= threshold) {
        console.log('end');
        video();
    }
}
}
</script>
</body>
</html>
<?php
}
?>