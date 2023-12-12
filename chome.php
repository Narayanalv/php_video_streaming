<?php
session_start();
include('connection.php');
$rowvideo2 = array ();
$rowddesc2 = array ();
$view22=array();
$rowuid2=array ();
$cname2=array();
$images22=array();
if(isset($_GET['cname'])){
$follled="follow";
$folvis="visible";
$folcol="red";
$id=$_GET['cname'];
if(isset($_SESSION['id']) && $_SESSION['id']!=''){
$uid=$_SESSION['id'];
$sql1="SELECT `following` from `login` where `id`=$uid";
$result1=$conn->query($sql1);
if($result1->num_rows > 0){
    $row=$result1->fetch_assoc();
    if($row['following']!=null && $row['following']!=''){
        $following=$row['following'];
        $dataType = gettype($following);
        if($dataType=='string'){
        $arr=explode(" ", $following);
        if(in_array($id,$arr)){
            $follled="following";
            $folcol="rgb(184, 184, 184)";
        }
        $arr=implode(" ", $arr);
    }else{
            if($following==$id){
                $follled="following";
                $folcol="rgb(184, 184, 184)";
            }
        }
    }
}
if($id===$uid){
    $folvis="hidden";
    $folcol="green";
}
}
$fol=0;
$sql = "SELECT `profile`,`channelname`,`followers` FROM channel WHERE lid = $id";
$result = $conn->query($sql);
$sql1="SELECT `likev`,`save` FROM `login` WHERE id=$id";
$resu=$conn->query($sql1);
$ro=$resu->fetch_assoc();
if($resu->num_rows > 0){
    $likev=null;
    $save=null;
    $video2s='';
    $desc2='';
    $views2='';
    $chname2='';
    $images2='';
    $iid12='';
    $images22='';
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
    if($likev!=null && $likev!=''){
    for($i = 0; $i < count($li); $i++){
        $sql="SELECT channel.profile, main.uid, main.videoname, main.description, main.view, main.cname FROM main JOIN channel ON main.uid = channel.lid WHERE main.id=$li[$i]";
        $result2=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result2) > 0)
        if ($row = mysqli_fetch_assoc($result2)){
            $rowvideo2[$i]=$row['videoname'];
            $rowuid2[$i]=$row['uid'];
            $rowddesc2[$i]=$row['description'];
            $view22[$i]=$row['view'];
            $cname2[$i]=$row['cname'];
            $img2=$row['profile'];
            $imgs1=base64_encode($img2);
            $imges2[$i]=$imgs1;
            $img2='';
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
    $images1='';
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
    $images1=json_encode($imges1);
    $iid1=json_encode($rowuid1);
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='icon' type='image/x-icon' href='./imgs/logo.png'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cname ?></title>
    <script src="jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="uastyle.css">
    <style>
        .text{background-color:transparent}
    </style>
</head>
<body style="background-color:grey;" onload="video()">
<div class="al" style="display:inline-block;width:100%;height:100%;">
<div class="mylist" style="height:600px;">
    <div class="loghold">
        <img class="logo" src="<?php echo $image1;?>"><br><p style="font-size:40px;margin-top :100px;text-align:center;"><?php echo $cname; ?></p><p style="margin-top:-40px;margin-left:60px;">followers <?php echo $fol; ?></p>
    </div>
<div>
<div style="cursor: pointer;;position: absolute;top: 0%;right: 1%;width: 50px;height: 50px;">
        <?php 
        $image1='./imgs/sign.png';
        $text='Sign In';
        $hid="hidden";
        $herf='login.php';
    if(isset($_SESSION['id']) && $_SESSION['id']!=''){
    $sql = "SELECT `profile` FROM channel WHERE lid = $uid";
    $herf='';
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $image_data = $row['profile'];
        $data=base64_encode($image_data);
        $image1 = "data:image/jpeg;base64,$data";
        $text='Sign Out';
        $hid="visible";
    }
}
?>
        <a href="<?php echo $herf; ?>"><img style="visibility:<?php echo $folvis; ?>;vertical-align:middle;width:100%;height:100%;" class="signicon" src="<?php echo $image1 ?>"></a>
        </div>
    <div class="foll" style="visibility:<?php echo $folvis ?>;background-color:<?php echo $folcol ?>;"><p class="follval" style="text-align:center;"><?php echo $follled; ?></p></div>
    <div class="mark m11" style="background-color: #e6dff7;">
        <div class="home hom">
            <img id="img" src="./imgs/home.png" alt="home">
            <span class="text">&nbsp; Videos</span>
        </div>
        <div class="home likev" style="margin-top:20px;">
            <img id="img" src="./imgs/home.png" alt="home">
            <span class="text">&nbsp; Liked Videos</span>
        </div>
        <div class="home savev" style="margin-top:20px;">
            <img id="img" src="./imgs/home.png" alt="home">
            <span class="text">&nbsp; Saved Videos</span>
        </div>
    </div>
</div>
</div>
<p class="namehold" style="text-align:center;margin-top: -600px;vertical-align:middle;"></p>
<div class="videoholder" style="visibility:hidden;margin-top: -550px;">
</div>
<div class="like" style="visibility:hidden;margin-top: -550px;"></div>
<div class="save" id="sav" style="visibility:hidden;margin-top: -550px;"></div>
</div>
</div>
<script>
const namehold=document.querySelector('.namehold');
const videoholder=document.querySelector('.videoholder');
const a=document.querySelector('.a');
const al=document.querySelector('.al');
const like=document.querySelector('.like');
const likev=document.querySelector('.likev');
const save=document.querySelector('.save');
const sav=document.getElementById('sav');
const savev=document.querySelector('.savev');
const foll=document.querySelector('.foll');
var hedding="video";
var des;
    var names;
    var j=0;
    var viw;
    function video(){
        sav.style.visibility="hidden";
        videoholder.style.visibility="visible";
        like.style.visibility="hidden";
        namehold.innerHTML=hedding;
        var k=<?php echo $rowcount ?>;
        if(k>0){
        des='<?php echo $desc ?>';
        names='<?php echo $video ?>';
        viw='<?php echo $views ?>';
        var descrip=JSON.parse(des);
        var videon=JSON.parse(names);
        var vview=JSON.parse(viw);
          for (var i = j; i < k; i++){
            if(videon[i]!=null){
            var ancher=document.createElement('a');
            var holder=document.createElement('div');
            var videoElement = document.createElement('video');
            var description = document.createElement('div');
            var logodesh=document.createElement('div');
            if(vview[i]==null){
                vview[i]='';
            }
            if(descrip[i].length >= 38){
                var dis=descrip[i].substr(0,38)+'....';
            }else{
                var dis=descrip[i];
            }
            holder.style.boxShadow='black 1px 3px 10px 1px';
            holder.style.width='310px';
            holder.style.height='215px';
            holder.style.marginLeft='20px';
            holder.style.marginTop='10px';
            holder.style.display='inline-block';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
            holder.style.borderColor="1px solid white";
            videoElement.src = './src/'+videon[i];
            ancher.href="viewv.php?src="+videoElement.src;
            videoElement.controls = false;
            videoElement.className = 'video-class-'+i+" vidh";
            videoElement.style.width='99%';
            videoElement.style.zIndex='10';
            videoElement.style.height='80%';
            videoElement.style.borderRadius='20px';
            logodesh.style.width='99%';
            logodesh.style.height='18%';
            logodesh.style.background="inherit";
            logodesh.style.borderRadius="20px";
            description.style.width="97%";
            description.style.display="inline-block";
            description.style.background="inherit";
            description.style.verticalAlign='top';
            description.style.borderRadius="20px";
            description.innerHTML=dis+'<br>  views '+vview[i];
            description.style.paddingLeft="10px";
            videoholder.appendChild(holder);
            holder.appendChild(ancher);
            ancher.appendChild(videoElement);
            holder.appendChild(logodesh);
            logodesh.appendChild(description);
            videoElement.addEventListener('mouseleave', handleMouseLeave);
            videoElement.addEventListener('mouseenter', handleMouseEnter);
            videoElement.addEventListener('click', handleClick);
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
          var v=document.querySelector('.video-class-0');
            v.style.borderTopLeftRadius="10px";
        }
        var no=videoholder.childElementCount;
        if (no === 0){
    $(".videoholder").html('no video')
    videoholder.style.textAlign="center";
    videoholder.style.fontSize='30px';    
    }
  }
var des1;
var names1;
var viw1;
var cname1;
var img1;
var id1;
savev.addEventListener('click',() =>{
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
hedding='Saved Videos';
namehold.innerHTML=hedding;
sav.style.visibility="visible";
videoholder.style.visibility="hidden";
like.style.visibility="hidden";
    var save='<?php echo $save ?>';
    if(save!=null && save!=''){
        var k=<?php echo $j ?>;
        des1='<?php echo $desc1 ?>';
        names1='<?php echo $video1s ?>';
        viw1='<?php echo $views1 ?>';
        cname1='<?php echo $chname ?>';
        img1='<?php echo $images1 ?>';
        id1='<?php echo $iid1 ?>';
        var descrip=JSON.parse(des1);
        var videon=JSON.parse(names1);
        var vview=JSON.parse(viw1);
        var ccname=JSON.parse(cname1);
        var imges1=JSON.parse(img1);
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
            holder.style.boxShadow='black 1px 3px 10px 1px';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
            holder.style.marginTop='10px';
            holder.style.width='310px';
            holder.style.height='215px';
            holder.style.marginLeft='20px';
            holder.style.display='inline-block';
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
            description.style.backgroundColor='inherit';
            description.style.color='white';
            description.title=descrip[i];
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
            var url='chome.php?cname='+uidd;
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
hedding='Liked Videos';
namehold.innerHTML=hedding;
videoholder.style.visibility="hidden";
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
                var dis=descrip[i]
            }
            holder.style.boxShadow='black 1px 3px 10px 1px';
            holder.style.width='310px';
            holder.style.height='215px';
            holder.style.display='inline-block';
            holder.style.marginTop='10px';
            holder.style.marginLeft='20px';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
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
            description.style.color='white';
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
  var videoId = videoElement.getAttribute('data-video-id'); // Get the video ID from the data attribute
  var videoDescription = videoElement.getAttribute('data-video-description'); // Get the video description from the data attribute
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
    hedding="video";
    namehold.innerHTML=hedding;
    like.style.visibility="hidden";
    videoholder.style.visibility="visible";
    sav.style.visibility="hidden";
    video();
});
chid=<?php echo $id; ?>;
foll.addEventListener('click',()=>{
    $.ajax({
        type: "POST",
        url: "foll.php",
        data: {chid:chid},
        success: function (response) {
            alert(response)
            if(response=="succa"){
                $(".foll").css("background-color", "rgb(184, 184, 184)");
                $(".foll").html('following');
            }else{
                $(".foll").css("background-color", "red");
                $(".foll").html('follow');
            }
        }
    });
})
const follval=document.querySelector('.follval');
foll.addEventListener('mouseover',() =>{
    var a=follval.innerHTML;
    console.log(a)
    if(a=="following"){
        foll.style.backgroundColor='red';
    }else{
        foll.style.backgroundColor="green";
    }
})
foll.addEventListener('mouseout',() =>{
    var a=follval.innerHTML;
    if(a=="following"){
        foll.style.backgroundColor="rgb(184, 184, 184)";
    }else{
        foll.style.backgroundColor="red";
    }
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
    </style>
</head>
<body>
    <div style="text-align:center;font-size:30px;"><span>No user found<span></div>
</body>
</html>
<?php
}
?>