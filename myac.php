<?php
include('connection.php');
session_start();
if(isset($_SESSION['id'])){
$id=$_SESSION['id'];
$follled="follow";
$folvis="visible";
if(isset($_SESSION['id'])!=''){
$uid=$_SESSION['id'];
$sql1="SELECT `following` from `login` where `id`=$uid";
$result1=$conn->query($sql1);
if($result1->num_rows > 0){
    $row=$result1->fetch_assoc();
    if($row['following']!=null && $row['following']!=''){
        $following=$row['following'];
        $dataType = gettype($following);
        if($dataType=='integer'){
        $arr=explode(" ", $following);
        $arr=explode(" ", $arr);
        if(in_array($id,$arr)){
            $follled="following";
            $folcol="rgb(184, 184, 184)";
        }}else{
            if($following==$id){
                $follled="following";
                $folcol="rgb(184, 184, 184)";
            }
        }
    }
}
if($id==$uid){
    $folvis="hidden";
}
}
$fol=0;
//profile image
$sql = "SELECT `profile`,`channelname`,`followers` FROM channel WHERE lid = $id";
$result = $conn->query($sql);
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
//counting videos
$cname="No user found";
$sql="SELECT count(*) as `count` FROM main WHERE uid = $id";
$result1=$conn->query($sql);
$rows=$result1->fetch_assoc();
if ($result1->num_rows > 0) {
$rowcount=$rows['count'];
$video='';
$desc='';
$views='';
$video='';
$desc='';
$views='';
$rowvideo = array ();
$rowddesc = array ();
$view=array();
if($rowcount>=0){
$sql="select `videoname`, `description`,`view`,`cname` from main where uid=$id";
$result2=mysqli_query($conn, $sql);
if(mysqli_num_rows($result2) > 0)
while ($row = mysqli_fetch_assoc($result2)){
$rowvideo[]=$row['videoname'];
$rowddesc[]=$row['description'];
$view[]=$row['view'];
$cname=$row['cname'];
}
$video=json_encode($rowvideo);
$desc=json_encode($rowddesc);
$views=json_encode($view);
}
}
$image1='./imgs/nop.png';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $image_data = $row['profile'];
    $cname=$row['channelname'];
    $imag2 = base64_encode($image_data);
    $image1="data:image/jpeg;base64,$imag2";
    if($row['followers']!=null && $row['followers']!=''){
        $fol=$row['followers'];
    }
}
$cname=$_SESSION['usechannel'];
$sql = "SELECT `profile` FROM channel WHERE lid = $id";
$result = $conn->query($sql);
$sql="SELECT count(*) as `count` FROM main WHERE uid = $id";
$result1=$conn->query($sql);
$rows=$result1->fetch_assoc();
if ($result1->num_rows > 0) {
$rowcount=$rows['count'];
$sql="select `videoname`, `description` from main where uid=$id";
$result2=mysqli_query($conn, $sql);
if(mysqli_num_rows($result2) > 0)
$rowvideo = array ();
$rowddesc = array ();
while ($row = mysqli_fetch_assoc($result2)){
$rowvideo[]=$row['videoname'];
$rowddesc[]=$row['description'];
}
$video=json_encode($rowvideo);
$desc=json_encode($rowddesc);
}
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $image_data = $row['profile'];
    $image1 = base64_encode($image_data);
} else {
    echo "Image not found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='icon' type='image/x-icon' href='data:image/jpeg;base64,<?php echo $image1;?>'/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Account</title>
    <script src="jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="uastyle.css">
    <style>
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
        @media only screen and (max-width: 600px) {
  .videohplder div {
    width:200px;
  }
  video{width:100%;}
}
a {
    text-decoration: none;
    color: inherit;
    cursor: default;
}
.editv{display: inline-block;position: absolute;top: 80px;left: 90px;color: white;opacity: .5;text-align: center;visibility:hidden;}
    </style>
</head>
<body style="background-color:grey;" onload="video()">
<div class="al">
<div class="mylist">
    <div class="loghold">
    <img class="logo" src="data:image/jpeg;base64,<?php echo $image1;?>"><div class="editv"><a href="editprofile.php" class="editv1" style="font-size:20px;">edit</a></div><br><p style="font-size:40px;margin-top :100px;text-align:center;"><?php echo $cname; ?></p>
    </div>
<div>
    <div class="mark m11" style="background-color:transparent;">
        <div class="home hom" style="background-color:rgb(21, 115, 197);">
            <img id="img" src="./imgs/upd.png" alt="home">
            <span class="text" style="background-color:transparent;">&nbsp; Videos</span>
        </div>
        <div class="home likev" style="margin-top:20px;">
            <img id="img" src="./imgs/like.png" alt="home">
            <span class="text" style="background-color:transparent;">&nbsp; Liked Videos</span>
        </div>
        <div class="home savev" style="margin-top:20px;">
            <img id="img" src="./imgs/library.png" alt="home">
            <span class="text" style="background-color:transparent;">&nbsp; Saved Videos</span>
        </div>
        <div class="home historyv" style="margin-top:20px;">
            <img id="img" src="./imgs/his.png" alt="home">
            <span class="text" style="background-color:transparent;">&nbsp; History</span>
        </div>
    </div>
</div>
</div>
<p class="namehold" style="text-align:center;vertical-align:middle;margin-top: -600px;"></p>
<div class="videoholder" style="position: relative;margin-top: -550px;"></div>
<div class="like" style="visibility:hidden;margin-top: -550px;"></div>
<div class="save" id="sav" style="visibility:hidden;margin-top: -550px;"></div>
<div class="history" style="visibility:hidden;margin-top: -550px;margin-left:220px;"></div>
</div>
<div class="video1">
    <div style="margin-top: 2%;margin-left: 15%;">
    <form class="form" action="avupload.php" method="POST" enctype="multipart/form-data">
        Description:<br> <textarea rows="2" cols="50" style="width: 300px;height: 150px;" name="newname" placeholder="Description of your videos"></textarea><input style="position: absolute;top: 0%;right: 0%;background-color: #ececec;margin-top: 4px;margin-right: 5px;border-radius: 20px;" class="cancel" type="button" value="x">
        <div class="progress" style="width:300px;  margin-left: 5px;">
        <div class="progressbar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%;background-color: #50ff00;height: 10px;visibility:hidden;">
        </div>
        </div>
        <input style="margin-top: 10px;display: block;text-align:center;margin-left:-6%;height: 40px;width: 100%;" type="file" name="my_video">
        <input style="margin-top: 10px;text-align:center;margin-left:16%;width:auto;" type="submit" value="submit" name="submit" onclick="vid()">
        <div style="height:20px;"></div>
    </form>
    </div>
</div>
<div>
    <div id="up1"><div style="background:transparent;"><p style="background:transparent;" id="up">Upload</p></div></div>
    <div class="box">
    </div>
    </div>
<script>
    const namehold=document.querySelector('.namehold');
    const videoholder=document.querySelector('.videoholder');
    const up1=document.getElementById('up1');
    const box=document.querySelector('.box');
    const al=document.querySelector('.al');
    const like=document.querySelector('.like');
const likev=document.querySelector('.likev');
const save=document.querySelector('.save');
const history=document.querySelector('.history');
const historyv=document.querySelector('.historyv');
const sav=document.getElementById('sav');
const savev=document.querySelector('.savev');
const video1=document.querySelector('.video1');
const logo=document.querySelector('.logo');
const editv=document.querySelector('.editv')
const editv1=document.querySelector('.editv1')
up1.addEventListener('click',() => {
    video1.style.visibility='visible';
    video1.classList.add('active');
    al.style.filter="blur(20px)";
})
const cancel=document.querySelector('.cancel');
cancel.addEventListener('click',() => {
    video1.classList.remove('active');
    video1.style.transition='.5s';
    video1.style.visibility='hidden';
    al.style.filter="blur(0px)";
})
var hedding="video";
var des;
var names;
function video(){
    des='<?php echo $desc ?>';
    names='<?php echo $video ?>';
    var descrip=JSON.parse(des);
    var videon=JSON.parse(names);
    namehold.innerHTML=hedding;
    function removeElement(element) {
    if (element && element.parentNode) {
        element.parentNode.removeChild(element);
    }
}
function removeAllElements() {
    while (sav.firstChild) {
        removeElement(sav.firstChild);
    }
}
removeAllElements();
function removeAllElement() {
    while (like.firstChild) {
        removeElement(like.firstChild);
    }
}
removeAllElement();
function removeAllElement1() {
    while (videoholder.firstChild) {
        removeElement(videoholder.firstChild);
    }
}
removeAllElement1();
sav.style.visibility="hidden";
history.style.visibility="hidden";
        videoholder.style.visibility="visible";
        like.style.visibility="hidden";
        for (var i = 0; i < <?php echo $rowcount; ?>; i++){
          var holder=document.createElement('div');
          var ancher1=document.createElement('a');
          var del=document.createElement('div');
          var delimg=document.createElement('img');
          var videoElement = document.createElement('video');
          var description = document.createElement('div');
          var logodesh=document.createElement('div');
          if(descrip[i].length >= 40){
                var dis=descrip[i].substr(0,40)+'......';
            }else{
                var dis=descrip[i]
            }
            holder.style.boxShadow='black 1px 3px 10px 1px';
            holder.style.marginTop='10px';
          holder.style.height='220px';
          holder.style.marginLeft='15px';
          holder.style.width='352px';
          holder.className="vidholder";
          holder.style.display='inline-block';
          holder.style.marginLeft='15px';
          holder.style.borderRadius="20px";
          holder.style.borderColor="1px solid white";
          videoElement.src = './src/'+videon[i];
          ancher1.href="viewv.php?src="+videoElement.src;
          del.style.width='10%';
          del.style.marginTop="-18.5%";
          del.style.marginLeft="22%";
          del.className='vis';
          del.style.backgroundColor="transparent";
          delimg.className='visimg';
          del.style.height='10%';
          del.style.position="absolute";
          del.align="center";
          del.style.display='inline-block';
          delimg.style.width="20%";
          delimg.style.height="40%";
          delimg.style.left="80%";
          delimg.name=videon[i];
          delimg.style.top="50%";
          delimg.style.position="absolute";
          delimg.style.cursor="pointer";
          delimg.style.transform="translate(-50%, -50%)";
          delimg.style.visibility='hidden';
          delimg.src="./imgs/delete.png";
          videoElement.controls = false;
          videoElement.className = 'video-class-'+i;
          videoElement.style.width='100%';
          videoElement.style.zIndex='10';
          videoElement.style.borderRadius="20px";
          videoElement.style.height='90%';
          logodesh.style.width='98%';
          logodesh.style.marginLeft='1%';
            logodesh.style.height='20px';
            logodesh.style.marginTop="-5px";
            logodesh.style.background="inherit";
            logodesh.style.borderRadius="20px";
          description.style.paddingLeft="10px";
          description.style.borderRadius="20px";
          description.style.display="inline-block";
          description.style.position="absolute";
          description.innerHTML=dis;
          description.title=descrip[i];
          videoholder.appendChild(holder);
          holder.appendChild(ancher1);
          ancher1.appendChild(videoElement);
          holder.appendChild(logodesh);
          logodesh.appendChild(description);
          holder.appendChild(del);
          del.appendChild(delimg);
          del.addEventListener('mouseleave',leave);
          del.addEventListener('mouseenter',enter);
          delimg.addEventListener('click',delet);
          delimg.addEventListener('mouseleave',leave1);
          delimg.addEventListener('mouseenter',enter1);
          videoElement.addEventListener('focus', handleFocus);
          videoElement.addEventListener('mouseleave', handleMouseLeave);
          videoElement.addEventListener('mouseenter', handleMouseEnter);
        }
        var no=videoholder.childElementCount;
        if (no === 0){
    $(".videoholder").html('no video')
    videoholder.style.textAlign="center";
    videoholder.style.fontSize='30px';    
    }
        function delet(event){
            var elem=event.target;
            var vname=elem.name;
            var url=window.location.href;
            $.ajax({
                type: "POST",
                url: "dele.php",
                data: {videoname:vname},
                success: function (response) {
                    alert(response);
                    if(response=='success'){
                        window.href=url;
                    }
                }
            });
        }
        function handleFocus(event) {
          var videoElement = event.target;
          videoElement.play();
        }
        function handleMouseEnter(event) {
          var videoElement = event.target;
           videoElement.play();
        }
        function leave(event) {
          var Element = event.target;
          var childElement = Element.firstElementChild;
          childElement.style.visibility='hidden';
        }
        function enter(event) {
          var Element = event.target;
          var childElement = Element.firstElementChild;
          childElement.style.visibility='visible';

        }
        function leave1(event) {
          var Element = event.target;
          Element.style.background="none";
          Element.style.opacity='1';
        }
        function enter1(event) {
          var Element = event.target;
          Element.style.background="grey";
          Element.style.borderRadius="5px";
        }
        function handleMouseLeave(event) {
          var videoElement = event.target;
          videoElement.pause();
        }
        var v=document.querySelector('.video-class-0');
          v.style.borderTopLeftRadius="10px";
}
function vid(){
  var progressbar = document.querySelector('.progressbar');
  progressbar.style.visibility="visible";
  progressbar.style.width="50%";
}
var des1;
var names1;
var viw1;
var cname1;
var img11;
var id1;
savev.addEventListener('click',() =>{
    savev.style.backgroundColor="rgb(21, 115, 197)";
    likev.style.backgroundColor="rgb(184, 184, 184)";
    hom.style.backgroundColor="rgb(184, 184, 184)";
    historyv.style.backgroundColor="rgb(184, 184, 184)";
    function removeElement(element) {
    if (element && element.parentNode) {
        element.parentNode.removeChild(element);
    }
}
function removeAllElements() {
    while (sav.firstChild) {
        removeElement(sav.firstChild);
    }
}
removeAllElements();
function removeAllElement() {
    while (videoholder.firstChild) {
        removeElement(videoholder.firstChild);
    }
}
removeAllElement();
function removeAllElement1() {
    while (like.firstChild) {
        removeElement(like.firstChild);
    }
}
removeAllElement1();
removeAllElement1();
function removeAllElement2() {
    while (history.firstChild) {
        removeElement(history.firstChild);
    }
}
removeAllElement2();
hedding='Saved Videos';
namehold.innerHTML=hedding;
sav.style.visibility="visible";
videoholder.style.visibility="hidden";
history.style.visibility="hidden";
like.style.visibility="hidden";
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
            holder.style.boxShadow='black 1px 3px 10px 1px';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
            holder.style.marginTop='10px';
            holder.style.height='220px';
          holder.style.marginLeft='15px';
          holder.style.display='inline-block';
          holder.style.width='312.88px';
            videoElement.src = './src/'+videon[i];
            ancher.href="viewv.php?src="+videoElement.src;
            videoElement.controls = false;
            videoElement.className = 'video-class-'+i+" vidh";
            videoElement.style.width='100%';
            videoElement.style.zIndex='10';
            videoElement.style.height='80%';
            videoElement.style.borderRadius="20px";
            imgs.style.width='15%';
            imgs.style.height='100%';
            imgs.style.borderRadius="60px";
            imgs.style.zIndex="100";
            imgs.name=id11[i];
            ancher1.href="chome.php?cname="+id11[i];
            imgs.src='data:image/png;base64,'+imga;
            logodesh.style.width='100%';
            logodesh.style.height='20%';
            imgs.style.verticalAlign='top';
            description.style.width="80%";
            description.style.display="inline-block";
            description.style.verticalAlign='top';
            description.style.backgroundColor='inherit';
            description.innerHTML=descrip[i]+'<br>'+ccname[i]+'  views '+vview[i];
            logodesh.style.backgroundColor='inherit';
            logodesh.style.borderRadius="20px";
            description.title=descrip[i];
            sav.appendChild(holder);
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
    $("#sav").html('no video')
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
likev.addEventListener('click',() =>{
    likev.style.backgroundColor="rgb(21, 115, 197)";
    savev.style.backgroundColor="rgb(184, 184, 184)";
    hom.style.backgroundColor="rgb(184, 184, 184)";
    historyv.style.backgroundColor="rgb(184, 184, 184)";
    function removeElement(element) {
    if (element && element.parentNode) {
        element.parentNode.removeChild(element);
    }
}
function removeAllElements() {
    while (like.firstChild) {
        removeElement(like.firstChild);
    }
}
removeAllElements();
function removeAllElement() {
    while (videoholder.firstChild) {
        removeElement(videoholder.firstChild);
    }
}
removeAllElement();
function removeAllElement1() {
    while (sav.firstChild) {
        removeElement(sav.firstChild);
    }
}
removeAllElement1();
removeAllElement1();
function removeAllElement2() {
    while (history.firstChild) {
        removeElement(history.firstChild);
    }
}
removeAllElement2();
hedding='Liked Videos';
namehold.innerHTML=hedding;
videoholder.style.visibility="hidden";
history.style.visibility="hidden";
like.style.visibility="visible";
sav.style.visibility="hidden";
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
            holder.style.boxShadow='black 1px 3px 10px 1px';
            holder.style.height='220px';
          holder.style.marginLeft='15px';
          holder.style.width='312.88px';
            holder.style.display='inline-block';
            holder.style.marginTop='10px';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
            videoElement.src = './src/'+videon[i];
            ancher.href="viewv.php?src="+videoElement.src;
            videoElement.controls = false;
            videoElement.style.borderRadius='20px';
            videoElement.className = 'video-class-'+i+" vidh";
            videoElement.style.width='100%';
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
            logodesh.style.height='20%';
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
            like.appendChild(holder);
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
    $(".like").html('no video')
    like.style.textAlign="center";
    like.style.fontSize='30px';    
    }
});
const hom=document.querySelector('.hom')
hom.addEventListener('click',()=> {
    hom.style.backgroundColor="rgb(21, 115, 197)";
    savev.style.backgroundColor="rgb(184, 184, 184)";
    likev.style.backgroundColor="rgb(184, 184, 184)";
    historyv.style.backgroundColor="rgb(184, 184, 184)";
    function removeElement(element) {
    if (element && element.parentNode) {
        element.parentNode.removeChild(element);
    }
}
function removeAllElements() {
    while (videoholder.firstChild) {
        removeElement(videoholder.firstChild);
    }
}
removeAllElements();
function removeAllElement1() {
    while (like.firstChild) {
        removeElement(like.firstChild);
    }
}
removeAllElement1();
function removeAllElement() {
    while (sav.firstChild) {
        removeElement(sav.firstChild);
    }
}
removeAllElement();
removeAllElement1();
function removeAllElement2() {
    while (history.firstChild) {
        removeElement(history.firstChild);
    }
}
removeAllElement2();
    hedding="video";
    namehold.innerHTML=hedding;
    like.style.visibility="hidden";
    videoholder.style.visibility="visible";
    sav.style.visibility="hidden";
    video();
});
historyv.addEventListener('click',()=>{
    historyv.style.backgroundColor="rgb(21, 115, 197)";
    savev.style.backgroundColor="rgb(184, 184, 184)";
    hom.style.backgroundColor="rgb(184, 184, 184)";
    likev.style.backgroundColor="rgb(184, 184, 184)";
    function removeElement(element) {
    if (element && element.parentNode) {
        element.parentNode.removeChild(element);
    }
}
function removeAllElements() {
    while (like.firstChild) {
        removeElement(like.firstChild);
    }
}
removeAllElements();
function removeAllElement() {
    while (videoholder.firstChild) {
        removeElement(videoholder.firstChild);
    }
}
removeAllElement();
function removeAllElement1() {
    while (sav.firstChild) {
        removeElement(sav.firstChild);
    }
}
removeAllElement1();
function removeAllElement2() {
    while (history.firstChild) {
        removeElement(history.firstChild);
    }
}
removeAllElement2();
hedding='History';
namehold.innerHTML=hedding;
videoholder.style.visibility="hidden";
like.style.visibility="hidden";
history.style.visibility="visible";
sav.style.visibility="hidden";
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
            holder.style.height='220px';
          holder.style.marginLeft='15px';
            holder.style.width='312.88px';
            holder.style.display='inline-block';
            holder.style.marginTop='10px';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
            videoElement.src = './src/'+videon[i];
            ancher.href="viewv.php?src="+videoElement.src;
            videoElement.controls = false;
            videoElement.style.borderRadius='20px';
            videoElement.className = 'video-class-'+i+" vidh";
            videoElement.style.width='100%';
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
            logodesh.style.height='20%';
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
            history.appendChild(holder);
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
var no=history.childElementCount;
if (no === 0){
    $(".history").html('no video')
    history.style.textAlign="center";
    history.style.fontSize='30px';    
    }
})
logo.addEventListener('mouseenter',()=>{
    editv.style.visibility="visible";
})
logo.addEventListener('mouseleave',()=>{
    editv.style.visibility="hidden";
})
editv.addEventListener('mouseenter',()=>{
    editv.style.visibility="visible";
})
editv.addEventListener('mouseleave',()=>{
    editv.style.visibility="hidden";
})
editv1.addEventListener('mouseenter',()=>{
    editv.style.visibility="visible";
})
editv1.addEventListener('mouseleave',()=>{
    editv.style.visibility="hidden";
})
</script>
</body>
</html>
<?php
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='icon' type='image/x-icon' href='./imgs/logo.png'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No user found</title>
    <style>
        *{background-color:grey;}
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
<body style="background-color:grey;">
    <div style="text-align:center;font-size:30px;"><span>No user found<span></div>
    <div style="text-align:center;font-size:30px;"><a href="login.php"><img src="./imgs/sign.png"></a></div>
    <div style="text-align:center;font-size:30px;"><a href="login.php">No user found<a></div>
</body>
</html>
<?php
}
?>