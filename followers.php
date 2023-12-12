<?php
include('connection.php');
session_start();
$k=0;
$uid=null;
$fid=null;
$iidj='';
$videoj='';
$desj='';
$viewj='';
$cnaj='';
$images='';
$cnames='';
$liid='';
$i=0;
if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    $sql="SELECT `following` FROM `login` WHERE `id`=$id";
    $resu=$conn->query($sql);
    $row = mysqli_fetch_assoc($resu);
    $foll=$row['following'];
    if($foll!=null && $foll!=""){
    $folling=explode(" ",$foll);
    $fid=$folling[0];
    $lid=array();
    $cnam=array();
    $imges=array();
    $k=count($folling);
    for($i=0;$i<count($folling);$i++){
        $follow=$folling[$i];
        $sql1="SELECT `lid`, `channelname`, `profile` FROM `channel` WHERE `lid`=$follow";
        $result=$conn->query($sql1);
        while($row = mysqli_fetch_assoc($result)){
                $lid[]=$row['lid'];
                $cnam[]=$row['channelname'];
                $img=$row['profile'];
                $imgs=base64_encode($img);
                $imges[]=$imgs;
        }
        $images=json_encode($imges);
        $cnames=json_encode($cnam);
        $liid=json_encode($lid);
    }
}
}
if(isset($_POST['uidd'])){
    $uid=$_POST['uidd'];
    $iid=array();
    $cna=array();
    $viname=array();
    $des=array();
    $view=array();
        $sql2="SELECT `uid`, `videoname`, `description`, `view`, `cname`, `id` FROM main WHERE `uid`=$uid";
        $res=$conn->query($sql2);
        $i=0;
        while($roow=mysqli_fetch_assoc($res)){
            $cna[]=$roow['cname'];
            $viname[]=$roow['videoname'];
            $des[]=$roow['description'];
            $view[]=$roow['view'];
            $hidd=$uid;
            $i++;
        }
        $iidj=json_encode($iid);
        $videoj=json_encode($viname);
        $desj=json_encode($des);
        $viewj=json_encode($view);
        $cnaj=json_encode($cna);
        //$hidd=json_encode($hidd);
}else{
    if($fid!=null){
$uid=$fid;
$iid=array();
$cna=array();
$viname=array();
$des=array();
$view=array();
    $sql2="SELECT `uid`, `videoname`, `description`, `view`, `cname`, `id` FROM main WHERE `uid`=$uid";
    $res=$conn->query($sql2);
    $i=0;
    while($roow=mysqli_fetch_assoc($res)){
        $cna[]=$roow['cname'];
        $viname[]=$roow['videoname'];
        $des[]=$roow['description'];
        $view[]=$roow['view'];
        $hidd=$uid;
        $i++;
    }
    $iidj=json_encode($iid);
    $videoj=json_encode($viname);
    $desj=json_encode($des);
    $viewj=json_encode($view);
    $cnaj=json_encode($cna);
    //$hidd=json_encode($hidd);
}
}
        $image1='./imgs/sign.png';
        $text='Sign In';
        $hid="hidden";
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
        $href="login.php";
        $image1="./imgs/nop.png";
    }
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel='icon' type='image/x-icon' href='<?php echo $image1 ?>'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Followers</title>
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
.chanv{margin-left: 105px;margin-top: 208px;border-radius: 10px;position:fixed;display:inline;border-radius:10px;background-color:white;padding-left:5px;padding-right:5px;cursor: pointer;}
        </style>
    </head>
    <body onload="video()">
    <div>
    <div class="header">
        <div class="logoh">
        <div class="mh">
            <img class="menuh" src="./imgs/menu.png">
        </div>
            <a href="tubestream.php"><img class="logo" src="./imgs/logo.png" alt="logo"></a>
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
        <img style="vertical-align:middle;visibility:<?php echo $hid ?>;" class="signicon" src="<?php echo $image1 ?>"><a href="<?php echo $href ?>" class="sign"><span class="signtext"><?php echo $text; ?></span></a>
        </div>
    </div>
    <div id="m1">
    <form>
        <div class="mark m11">
            <div class="home hom" style="background-color: rgb(184, 184, 184);">
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
            <div class="home sub" name="" style="background-color: rgb(21, 115, 197);">
                <img id="img" class="img" name="follow" src="./imgs/subscription.png">
                <span class="text">Following</span>
            </div>
        </div>
        </form>
        <form>
        <div class="mark">
            <div class="home lib">
                <img id="img" class="img" name="Library" src="./imgs/library.png">
                <span class="text">Library</span>
            </div>
        </div>
        </form>
    </div>
    <form action="" method="POST" class="imghold" style="width: 92%;height: 120px;margin-left: 100px;margin-top: 88px;border-radius: 10px;position:fixed;">
    <input id="val" type="hidden" name="uidd">
</form>
    <span class="chanv">view channel</span>
    <div class="videoh" style="height: 550px;margin-top: 225px;background-color:red;display:block;margin-left:100px;background-color:#c5c5c5;">
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
const imghold=document.querySelector('.imghold')
const chanv=document.querySelector('.chanv');
const val=document.getElementById('val');
hom.addEventListener('click', () => {
    window.location.href = 'tubestream.php';
})
$('.sub').click(function() {
        videoh.style.display='inline-block';
        imghold.style.display='inline-block';
        chanv.style.display='inline-block';
      acc.style.display='inline-block';
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
            window.location.href = 'myac.php';
          }else if(response === "nochannel"){
            window.location.href = 'myac.php';
          }
          else if(response === "login"){
            alert('login');
          }
        }
      });
    });
    $('.ac').click(function() {
        videoh.style.display='none';
        imghold.style.display='none';
        chanv.style.display='none';
      hom.style.backgroundColor=" rgb(184, 184, 184)";
      ac.style.backgroundColor="rgb(21, 115, 197)";
      lib.style.backgroundColor=" rgb(184, 184, 184)";
      sub.style.backgroundColor=" rgb(184, 184, 184)";
      $.ajax({
        url: 'acc.php',
        type: 'POST',
        data: { check: 'check' },
        success: function(response) {
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
        }
      });
    });
    $('.lib').click(function() {
        videoh.style.display='none';
        imghold.style.display='none';
        chanv.style.display='none';
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
          }
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
    var iidd;
    function video(){
      //var names=JSON.parse(name);
      //var des=JSON.parse(des);
      k=<?php echo $k ?>;
      if(k!=0){
      imags='<?php echo $images ?>';
      names='<?php echo $cnames ?>';
      id='<?php echo $liid ?>';
      var imagess=JSON.parse(imags);
      var cname=JSON.parse(names);
      var iid=JSON.parse(id);
      iidd=iid[0];
      }
          for (var i = j; i < k; i++){
            if(cname[i]!=null){
            var holder=document.createElement('div');
            var img = document.createElement('img');
            var logodesh=document.createElement('span');
            var imga=imagess[i]
            if(cname[i].length >= 10){
                var dis=cname[i].substr(0,10)+'......';
            }else{
                var dis=cname[i];
            }
            holder.style.width='80px';
            holder.style.marginLeft='5px';
            holder.style.height='120px';
            holder.style.display='inline-block';
            holder.style.textAlign="center";
            holder.style.borderColor="1px solid white";
            holder.method="POST";
            holder.id = iid[i];
            holder.action="";
            holder.style.borderRadius="20px";
            img.style.width='80px';
            img.style.height='80px';
            img.style.borderRadius="60px";
            img.style.zIndex="100";
            img.value=iid[i];
            img.name="uuid";
            holder.name=iid[i];
            img.src='data:image/png;base64,'+imga;
            logodesh.style.width='100px';
            logodesh.style.height='19px';
            logodesh.style.borderRadius="20px";
            logodesh.style.backgroundColor="inherit";
            logodesh.innerHTML=dis;
            imghold.appendChild(holder);
            holder.appendChild(img);
            holder.appendChild(logodesh);
            holder.addEventListener('click',clickedlogo)
            chanv.name=iid[0];
          }
        }
        function clickedlogo(event){
            var vari = event.currentTarget;
            vari.style.backgroundColor="#c5c5c5";
            val.value=vari.name;
            imghold.submit();
}
var no=imghold.childElementCount;
if (no === 1){
    $(".imghold").html('no channels followed')
    imghold.style.textAlign="center";
    imghold.style.fontSize='30px';
    }else{
        vid();
    }
}
  chanv.addEventListener('click',()=>{
    var chan=chanv.name;
    url="chome.php?cname="+chan;
    window.location.href = url;
  })
  let hid;
  function vid(){
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
      //var names=JSON.parse(name);
      //var des=JSON.parse(des);
      var ki=<?php echo $i ?>;
      if(ki!=0){
      des='<?php echo $desj ?>';
      names='<?php echo $videoj ?>';
      id='<?php echo $iidj ?>';
      name='<?php echo $cnaj ?>';
      viw='<?php echo $viewj ?>';
      hid="<?php echo $hidd ?>";
      var imagess=JSON.parse(imags);
      var descrip=JSON.parse(des);
      var videon=JSON.parse(names);
      var iid=JSON.parse(id);
      var cnames=JSON.parse(name);
      var vview=JSON.parse(viw);
      }
          for (var i = j; i < ki; i++){
            if(videon[i]!=null){
            var ancher=document.createElement('a');
            var holder=document.createElement('div');
            var videoElement = document.createElement('video');
            var description = document.createElement('div');
            var logodesh=document.createElement('div');
            if(vview[i]==null){
                vview[i]='';
            }
            if(descrip[i].length >= 25){
                var dis=descrip[i].substr(0,25)+'......';
            }else{
                var dis=descrip[i]
            }
            holder.style.boxShadow='0px 3px 1px 1px black';
            holder.style.width='310px';
            holder.style.marginLeft='5px';
            holder.style.marginTop='10px';
            holder.style.height='215px';
            holder.style.display='inline-block';
            holder.style.boxShadow='box-shadow:0 5px 40px rgba(0,0,0,.30)';
            holder.style.borderColor="1px solid white";
            holder.style.borderRadius="20px";
            videoElement.src = './src/'+videon[i];
            ancher.href="viewv.php?src="+videoElement.src;
            videoElement.controls = false;
            videoElement.className = 'video-class-'+i+" vidh";
            videoElement.style.width='99%';
            videoElement.style.zIndex='10';
            videoElement.style.height='80%';
            videoElement.style.borderRadius='20px';
            logodesh.style.width='98%';
            logodesh.style.height='18%';
            logodesh.style.borderRadius="20px";
            description.style.width="80%";
            description.style.display="inline-block";
            description.style.verticalAlign='top';
            description.style.backgroundColor='transparent';
            description.style.color='white';
            description.innerHTML=dis+'<br>'+cnames[i]+'  views '+vview[i];
            logodesh.style.backgroundColor='#636363';
            description.title=descrip[i];
            description.style.paddingLeft="20px";
            videoh.appendChild(holder);
            holder.appendChild(ancher);
            ancher.appendChild(videoElement);
            holder.appendChild(logodesh);
            logodesh.appendChild(description);
            videoElement.addEventListener('mouseleave', handleMouseLeave);
            videoElement.addEventListener('mouseenter', handleMouseEnter);
            videoElement.addEventListener('click', handleClick);
          }
        }
        var channel=hid;
        var ele=videoh.childNodes;
        ele=ele.length;
  if (channel!="" && channel!=null){
    let chan=document.getElementById(channel);
    chan.style.backgroundColor="#c5c5c5";
  }
        function handleClick(event) {
  var videoElement = event.target;
  var videoSrc = videoElement.src;
  var videoId = videoElement.getAttribute('data-video-id');
  var videoDescription = videoElement.getAttribute('data-video-description');

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