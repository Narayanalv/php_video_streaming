<?php
include('connection.php');
session_start();
if(isset($_SESSION['name'])){
    $usname=$_SESSION['name'];
}else{
    $usname='';
//$_SESSION['id']='';
$_SESSION['uname']="";
$_SESSION['name']="";
$_SESSION['upass']="";
$_SESSION['usechannel']="";
$_SESSION['following']="";
}
if(isset($_GET['src'])!=null){
    $vna=$_GET['src'];
function getQueryParameter($parameterName) {
    $queryString = $_SERVER['QUERY_STRING'];
    $urlParams = array();
    parse_str($queryString, $urlParams);
    
    if (isset($urlParams[$parameterName])) {
        return $urlParams[$parameterName];
    } else {
        return null;
    }
}
$videosrc = getQueryParameter('src');
function getFileNameFromURL($url) {
    $startIndex = strrpos($url, '/') + 1;
    $endIndex = strpos($url, '?') !== false ? strpos($url, '?') : strlen($url);
    return substr($url, $startIndex, $endIndex - $startIndex);
}
$fileName = getFileNameFromURL($videosrc);
$stmt = $conn->prepare("SELECT channel.profile,main.uid, main.cname,main.view,main.likeno,main.description,main.id FROM main join channel ON main.uid = channel.lid WHERE main.videoname=?");
$stmt->bind_param("s", $fileName);
    $stmt->execute();
    $res = $stmt->get_result();
    if($row=$res->fetch_assoc()){
        $vvid=$row['id'];
        $iiid=$row['uid'];
        $cna=$row['cname'];
        $des=$row['description'];
        $img3=$row['profile'];
        $imgs3=base64_encode($img3);
        $imges3="data:image/jpeg;base64,".$imgs3;
        $dese=json_encode($des);
        $vi=$row['view'];
        if($row['likeno']!=null){
        $lik=$row['likeno'];
        }else{
            $lik=0;
        }
    }
}
$sql="select `videoname`, `description`,`uid`,`cname`,`view` from main";
    $result2=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result2) > 0)
    $rowvideo = array ();
    $rowddesc = array ();
    $rowuid=array ();
    $imges=array();
    $name=array();
    $view=array();
    $i=0;
    while ($row = mysqli_fetch_assoc($result2)){
    $rowvideo[$i]=$row['videoname'];
    $rowddesc[$i]=$row['description'];
    $rowuid[$i]=$row['uid'];
    $name[$i]=$row['cname'];
    $view[$i]=$row['view'];
    $sql="select `profile` from channel where lid=$rowuid[$i]";
    $res=$conn->query($sql);
    $imgs=array();
    if($row=$res->fetch_assoc()){
        $img=$row['profile'];
        $imgs=base64_encode($img);
        $imges[$i]=$imgs;
    }
    $i++;
    }
    $images=json_encode($imges);
    $iid=json_encode($rowuid);
    $video=json_encode($rowvideo);
    $desc=json_encode($rowddesc);
    $views=json_encode($view);
    $names=json_encode($name);
    $stmt->close();
    $stmt=$conn->prepare("SELECT `id`,`comment`,`ucid`,`name` FROM `comment` WHERE `vid`=?");
    $stmt->bind_param("i",$vvid);
    $stmt->execute();
    $cid1='';
    $com1='';
    $cnames1='';
    $cid='';
    $com='';
    $cnames='';
    $k=0;
    $re = $stmt->get_result();
    if ($re->num_rows > 0) {
            $cid1=array();
            $com1=array();
            $cnames1=array();
        while($rowss=mysqli_fetch_assoc($re)){
            $cid1[]=$rowss['id'];
            $com1[]=$rowss['comment'];
            $cnames1[]=$rowss['name'];
            $k+=1;
        }
        $cid=json_encode($cid1);
        $com=json_encode($com1);
        $cnames=json_encode($cnames1);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel='icon' type='image/x-icon' href='./imgs/logo.png'/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.7.0.min.js"></script>
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
        .vh{position: absolute;width: 100%;height: 80%;}
        .video{position: absolute;width: 100%;height: 100%;}
        .share, .saved, .like{width: 20%;height: 20%;display: inline-block;margin-left:10px;}
        .icons{margin-left: 70%;display:block;position: absolute;}
        .value{margin-left: 70%;display:block;position: absolute;margin-top:60px;}
        .vih{position:absolute;width:30%;height:84%;right:0%;top:100px;overflow-y: scroll;}
        .alh{overflow-y: scroll;width:70%;height:83%;position: absolute;top: 100px;}
        .desico{position:absolute;width:90%;height:20%;top:80%;}
        .ic{width:100%;height:100%;}
        .des{display:inline-block;width:90%;height:auto;}
        .vie{display:inline-block;width:10%;height:auto;}
        .comv{display: inline-block;position: absolute;width: 50px;height: 20px;top: 100px;left: 64%;cursor:pointer;}
        .ch{width: 30%;height: 78%;display: inline-block;margin-top: 120px;z-index: 10;margin-left: 70%;position: absolute;visibility: hidden;box-shadow: 1px 1px 3px black;}
        .comments{visibility: hidden;background:#f7b1db;transition: all 3s ease 0s;text-align: center;width: 10%;height: 9%;display: inline-block;z-index: 10;position: absolute;overflow-y: scroll;}
        .send{width:100%;height:100%;border-radius: 15px;}
        .send:hover{background-color: whitesmoke;border-top-right-radius: 700px;border-bottom-right-radius:700px;}
        .shareurl{border-radius:20px;background-color: grey;visibility:hidden;position:absolute;z-index: 100;top:80%;left:45%;text-align:center;color:white;font-size:20px;vertical-align:middle;box-shadow:0px 0px 2px;display:inline;padding-left:5px;padding-right:5px;}
        /*.like, .share,*/
    </style>
</head>
<body onload='video2()'>
    <div>
        <div class="header">
            <div class="logoh">
            <div class="mh">
                <img class="menuh" src="./imgs/menu.png">
            </div>
                <img class="logo" src="./imgs/logo.png" alt="logo">
            </div>
            <div class="search">
                <img class="seaicon" src="./imgs/search1.png" alt="search">
                <input class="textbox" type="text" placeholder="search" name="textbox" id="textbox">
            </div>
            <div class="mich">
                <img class="mic" src="./imgs/mic.png" alt="mic" onclick="speech()">
            </div>
            <div style="cursor: pointer;">
            <?php 
            $image1='./imgs/sign.png';
            $text='Login in';
            $src="./imgs/save.png";
            $hid="hidden";
        if(isset($_SESSION['id']) && $_SESSION['id']!=''){
            $id=$_SESSION['id'];
        $sql = "SELECT `profile` FROM channel WHERE lid = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $image_data = $row['profile'];
            $data = base64_encode($image_data);
            $image1 = "data:image/jpeg;base64,$data";
            $sql1="SELECT `save` FROM `login` WHERE `id`=$id";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0){
            $row = $result1->fetch_assoc();
            $text='Log Out';
            $hid="visible";
            if($row['save']!=null){
            $saved=$row['save'];
            $save=explode(' ',$saved);
            if(in_array($vvid, $save)){
                $src="./imgs/asaved.png";
            }
            }
            }
        }
    }
        ?>
        <img style="vertical-align:middle;visibility:<?php echo $hid ?>;" class="signicon" src="<?php echo $image1 ?>"><a href="login.php" class="sign"><span class="signtext"><?php echo $text; ?></span></a>
            </div>
        </div>
        <div id="m1" style="visibility: hidden;">
        <form action="tubestream.php" method="POST">
            <div class="mark m11">
                <div class="home hom">
                    <img id="img" src="./imgs/home.png" alt="home">
                    <span class="text">Home</span>
                </div>
            </div>
            </form>
            <form action="myac,php" method="POST">
            <div class="mark">
                <div class="ac home">
                    <img id="img"class="img" name="Shorts" src="./imgs/sign.png">
                    <span class="text">Account</span>
                </div>
            </div>
            </form>
            <form action="" method="POST">
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
        <div class="alh">
        <div class="vh">
        <video class="video" controls src=""></video>
        </div>
        <div class="desico">
            <a href="chome.php?cname=<?php echo $iiid?>" style="display:inline;"><img src="<?php echo $imges3 ?>" style="vertical-align:top;display:inline;width:100px;height:100px;border-radius:30px;"></a>
        <div class="des" style="display:inline;"></div>&nbsp;<div class="vie" style="display:inline;"></div>
        <div class="cnliv"></div>
        <div class="icons">
        <div class="like">
        <img class="ic ic1" src="./imgs/like.png">
        </div>
        <div class="share"><img class="ic ic2" src="./imgs/share.png">
        </div>
        <div class="saved"><img class="ic ic3" src=<?php echo $src ?>></div>
        </div>
        <div class="value"><div class="liho" style="margin-left:30px;"></div></div>
        </div>
        </div>
        <div class="vih">
        </div>
        <div class="comv">comments</div>
        <div class="ch" style="border-radius:20px;">
        <div class="comments" id="comments" style="visibility:hidden;text-align:left;">
        </div>
        <div class="tex" style="position:absolute;width:90%;height:5%;top:95%;margin-left:20px;visibility:hidden;z-index:15;">
            <input class="text1" style="width:95%;height:75%;border-radius: 20px;display:inline-block;">
            <div class="sendt" style="width:20px;height:23px;display:inline-block;position:absolute;cursor:pointer;"><img class="send" src="./imgs/send.png" alt="send"></div>
            </div>
        <div class="can" style="cursor:pointer;width:10px;height:10px;margin-left: 95%;position: absolute;margin-top: -95%;z-index: 11;visibility:hidden;">x</div>
        </div>
        <span class="shareurl" vertical-align="middle">URL copied</span>
        <script>
            const comv=document.querySelector('.comv');
            const sendt=document.querySelector('.sendt');
            const ch=document.querySelector('.ch');
            const tex=document.querySelector('.tex');
            const comments=document.querySelector('.comments');
            const idcomments=document.getElementById('comments');
            const ic2=document.querySelector('.ic2');
            const shareurl=document.querySelector('.shareurl');
            const urlshare=document.querySelector('.urlshare');
            const canshare=document.querySelector('.canshare');
            var response='';
            var fileName;
            function getQueryParameter(parameterName) {
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            return urlParams.get(parameterName);
        }
        var videosrc = getQueryParameter('src');
        function getFileNameFromURL(url) {
            var startIndex = url.lastIndexOf('/') + 1;
            var endIndex = url.indexOf('?') !== -1 ? url.indexOf('?') : url.length;
            return url.substring(startIndex, endIndex);
        }
        fileName = getFileNameFromURL(videosrc);
        var video=document.querySelector('.video');
        document.title = <?php echo $dese ?>;
        video.src='./src';
        video.src='./src/'+fileName;
        $('.des').html("<?php echo $des; ?>");
        $('.vie').html("<?php echo 'views    '.$vi?>");
        $('.liho').html("<?php echo $lik;?>");
        var ic1=document.querySelector('.ic1');
        $(document).ready(function () {
            $.ajax({
            type: "POST",
            url: "like.php",
            data: {vname:fileName},
            success: function (response) {
                if(response!==''){
                    console.log(response);
                    ic1.src = response;
                }
            }
        });
        });
        ic1.addEventListener('click', () => {
    if (ic1.src.includes('arlike.png')) {
        $.ajax({
            type: "POST",
            url: "like.php",
            data: {dcvname:fileName},
            success: function (response) {
                if(response!=='' && response!="elseelseelse"){
                    const delimiter=" ";
                    var array=response.split(delimiter);
                    if(array[2]=="deleted"){
                    ic1.src = array[0];
                    }
                    console.log(response);
                    $(".liho").html(array[1]);
                }
            }
        });
    } else if (ic1.src.includes('like.png')){
        $.ajax({
            type: "POST",
            url: "like.php",
            data: {acvname:fileName},
            success: function (response) {
                if(response!=='' && response!="elseelseelse"){
                    const delimiter=" ";
                    var array=response.split(delimiter);
                    if(array[2]=="liked"){
                    ic1.src = array[0];
                    }
                    console.log(response);
                    $(".liho").html(array[1]);
                }
            }
        });
    }
});
const m1=document.getElementById('m1');
const hom=document.querySelector('.hom');
const sub=document.querySelector('.sub');
const lib=document.querySelector('.lib');
const ac=document.querySelector('.ac');
const mh=document.querySelector('.mh');
const can=document.querySelector('.can');
var icon=document.getElementsByClassName('.ic');
const text1=document.querySelector('.text1');
const send=document.querySelector('.send');
mh.addEventListener('click',() => {
var allmen=document.getElementsByClassName('home');
var ele=document.getElementsByClassName('text');
if(m1.style.visibility=='visible'){
    for(var i=0; i<ele.length;i++){
    allmen[i].style.transition='.1s';
    allmen[i].style.width='0px';
    ele[i].style.width='0px';
    ele[i].style.display='inline';
    ele[i].style.visibility='hidden';
    allmen[i].style.visibility='hidden';
    }
    m1.style.transition='.5s';
    m1.style.visibility='hidden';
    m1.style.width='0px';
}
else{
    m1.style.transition='.5s';
    m1.style.visibility='visible';
    for(var i=0; i<ele.length;i++){
    allmen[i].style.transition='.5s';
    allmen[i].style.width='150px';
    ele[i].style.display='inline';
    m1.style.width='180px';
    ele[i].style.visibility='visible';
    allmen[i].style.visibility='visible';
}
}
})
$('document').ready(function(){
$.ajax({
    type: "POST",
    url: "viewh.php",
    data: {inputString: fileName},
    success: function (response) {
        if(response=="login"){
        alert(response);
        }
    }
});
});
const ic3=document.querySelector('.ic3');
$('.ic3').click(function(){
$.ajax({
    type: "POST",
    url: "save.php",
    data: {inputString:fileName},
    success: function (response) {
        if(response!="login"){
        ic3.src=response;
        if(response=="./imgs/save.png"){
            alert("removed");
        }else{
            alert("saved");
        }
        }
    }
});
});
can.addEventListener('click',()=>{
        comments.style.width='10%';
        comments.style.height='10%';
        comments.style.visibility="hidden";
        tex.style.visibility="hidden";
        ch.style.visibility="hidden";
        can.style.visibility="hidden";
  })
var des;
    var names;
    var j=0;
    var k=8;
    var id;
    var imags;
    var name;
    var viw;
    const vih=document.querySelector('.vih');
    $('.sub').click(function() {
      $.ajax({
        url: 'acc.php',
        type: 'POST',
        data: { check: 'check' },
        success: function(response) {
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
            alert('login');
          }
        }
      });
    });
    $('.lib').click(function() {
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
    function video2(){
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
      function removeElement(element) {
    if (element && element.parentNode) {
        element.parentNode.removeChild(element);
    }
}
function removeAllElements() {
    while (vih.firstChild) {
        removeElement(vih.firstChild);
    }
}
removeAllElements();
          for (var i = j; i < k; i++){
            if(videon[i]!=null){
            var holder=document.createElement('div');
            var ancher1=document.createElement('a');
            var ancher=document.createElement('a');
            var videoElement = document.createElement('video');
            var description = document.createElement('label');
            var logodesh=document.createElement('div');
            var imgs=document.createElement('img');
            var imga=imagess[i]
            if(vview[i]==null){
                vview[i]='';
            }
            holder.style.width='100%';
            holder.style.height='250px';
            holder.style.display='inline-block';
            holder.style.boxShadow='box-shadow:0 5px 40px rgba(0,0,0,.30)';
            videoElement.src = './src/'+videon[i];
            ancher.href="viewv.php?src="+videoElement.src;
            videoElement.controls = false;
            videoElement.className = 'video-class-'+i+" vidh";
            videoElement.style.width='99%';
            videoElement.style.zIndex='10';
            videoElement.style.height='80%';
            imgs.style.width='10%';
            imgs.style.height='99%';
            imgs.style.borderRadius="60px";
            imgs.style.zIndex="100";
            imgs.name=iid[i];
            ancher1.href="chome.php?cname="+iid[i];
            imgs.src='data:image/png;base64,'+imga;
            logodesh.style.width='100%';
            logodesh.style.height='19%';
            imgs.style.verticalAlign='top';
            description.style.width="80%";
            description.style.display="inline-block";
            description.style.verticalAlign='top';
            description.innerHTML=descrip[i]+'<br>'+cnames[i]+'  views '+vview[i];
            vih.appendChild(holder);
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
  comv.addEventListener('click',() =>{
var comment = document.querySelector('.comments')
var a = comment.style.visibility;
function removeElement(element) {
    if (element && element.parentNode) {
        element.parentNode.removeChild(element);
    }
}
function removeAllElements() {
    while (idcomments.firstChild) {
        removeElement(idcomments.firstChild);
    }
}
removeAllElements();
    if(a=='hidden'){
        a='visible';
        comments.style.visibility="visible";
        comments.style.transition='.5s';
        comments.style.width='100%';
        comments.style.height='95%';
        comments.style.display='block';
        can.style.visibility="visible";
        tex.style.visibility="visible";
        ch.style.visibility="visible";
        var ik=<?php echo $k ?>;
        ik=JSON.parse(ik);
        if(ik!=0){
        var commentsall='<?php echo $com; ?>';
    var cidd='<?php echo $cid; ?>';
    var cnam='<?php echo $cnames; ?>';
    commentsall=JSON.parse(commentsall);
    cidd=JSON.parse(cidd);
    cnam=JSON.parse(cnam);
    ik=JSON.parse(ik);
    for(var s=0; s<ik; s++){
        if(ik==1){
            cmnam=cnam;
            coment=commentsall;
        }else{
            cmnam=cnam[s]
            coment=commentsall[s]
        }
            var dcom=document.createElement('div');
            var cuname=document.createElement('label');
            var comt=document.createElement('label');
            dcom.style.width="auto";
            dcom.style.height="auto";
            dcom.style.marginLeft="10px";
            dcom.style.display="block";
            comt.style.display="inline";
            cuname.style.display="inline";
            cuname.style.width="auto";
            cuname.style.height="auto";
            cuname.style.fontSize="10px";
            cuname.innerHTML="&nbsp"+cmnam+"&nbsp";
            comt.innerHTML="&nbsp"+coment+"&nbsp<br>";
            comt.style.boxShadow='0px 0px 3px';
            cuname.style.boxShadow='0px 0px 3px yellow';
            comt.style.width="auto";
            comt.style.height="auto";
            comt.style.fontSize="20px";
            comt.style.borderRadius="20px";
            cuname.style.borderRadius="20px";
            cuname.style.borderColor="white";
            idcomments.appendChild(dcom);
            dcom.appendChild(comt);
            dcom.appendChild(cuname);
        }
    }else{
        var dcom=document.createElement('div');
            var cuname=document.createElement('label');
            var comt=document.createElement('label');
            dcom.style.textAlign="center";
            dcom.style.width="auto";
            dcom.style.height="auto";
            dcom.style.display="block";
            comt.style.display="block";
            cuname.style.display="block";
            comt.style.width="auto";
            comt.style.height="auto";
            comt.style.fontSize="20px";
            comt.innerHTML="Comment here";
            idcomments.appendChild(dcom);
            dcom.appendChild(comt);
    }
    }else{
        a='hidden';
        comments.style.visibility="hidden";
        can.style.visibility="hidden";
        tex.style.visibility="hidden";
        ch.style.visibility="hidden";
        comments.style.transition='.5s';
        comments.style.width='10%';
        comments.style.height='9%';
        comments.style.display='block';
    }
  })
send.addEventListener('click',() =>{
    var vvid='<?php echo $vvid; ?>';
    var comt1=text1.value;
    if(comt1!=''){
    $.ajax({
        type: "POST",
        url: "comment.php",
        data: {comt:comt1,vid:vvid},
        success: function (response) {
            alert(response)
            if(response!="login")
    var dcom=document.createElement('div');
    var cuname=document.createElement('label');
    var comt=document.createElement('label');
    dcom.style.marginLeft="10px"
    dcom.style.width="auto";
    dcom.style.height="auto";
    dcom.style.display="block";
    comt.style.display="block";
    cuname.style.display="block";
    cuname.style.width="auto";
    cuname.style.height="auto";
    cuname.style.fontSize="10px";
    cuname.innerHTML='<?php echo $usname ?>';
    comt.style.width="auto";
    comt.style.height="auto";
    comt.style.fontSize="20px";
    comt.innerHTML=comt1;
    idcomments.appendChild(dcom);
    dcom.appendChild(comt);
    dcom.appendChild(cuname);
        }
    });
}
})
ic2.addEventListener('click',() =>{
    var shareurll=window.location.href;
    shareurl.style.visibility="visible";
    navigator.clipboard.writeText(shareurll);
    setTimeout(function() {
    shareurl.style.visibility="hidden";
}, 800);
});
</script>
</body>
</html>