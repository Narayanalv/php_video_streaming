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
/*videohover.addEventListener('mouseenter', () =>{
    videohover.play();
    videohover.style.position = "absolute";
    vh.style.width="300px";
    vh.style.height="170px";
    videohover.style.position = "absolute";
    videohover.style.width="300px";
    videohover.style.height="170px";
    nm.style.width="300px";
})
videohover.addEventListener('mouseleave', () =>{
    videohover.pause();
    videohover.autoplay="none";
    vh.style.width="270px";
    vh.style.height="150px";
    videohover.style.position = "relative";
    videohover.style.width="100%";
    videohover.style.height="100%";
    nm.style.width="270px";
})*/
hom.addEventListener('click', () => {
    acc.style.display='none';
    videoh.style.display='inline-block';
    hom.style.backgroundColor="rgb(21, 115, 197)";
    ac.style.backgroundColor=" rgb(184, 184, 184)";
    lib.style.backgroundColor=" rgb(184, 184, 184)";
    sub.style.backgroundColor=" rgb(184, 184, 184)";
})
ac.addEventListener('click', () => {
    videoh.style.display='none';
    acc.style.display='inline-block';
    hom.style.backgroundColor=" rgb(184, 184, 184)";
    ac.style.backgroundColor="rgb(21, 115, 197)";
    lib.style.backgroundColor=" rgb(184, 184, 184)";
    sub.style.backgroundColor=" rgb(184, 184, 184)";
})
lib.addEventListener('click', () => {
    acc.style.display='none';
    videoh.style.display='none';
    hom.style.backgroundColor=" rgb(184, 184, 184)";
    ac.style.backgroundColor=" rgb(184, 184, 184)";
    lib.style.backgroundColor="rgb(21, 115, 197)";
    sub.style.backgroundColor=" rgb(184, 184, 184)";
})
sub.addEventListener('click', () => {
    hom.style.backgroundColor=" rgb(184, 184, 184)";
    ac.style.backgroundColor=" rgb(184, 184, 184)";
    lib.style.backgroundColor=" rgb(184, 184, 184)";
    sub.style.backgroundColor="rgb(21, 115, 197)";
})
/*// Array of video sources
var videoSources = ['./How To Make Autocomplete Search Box For Website Using HTML CSS & JavaScript.mp4', './scr/video.mp4', './scr/video.mp4'];
// Parent element to append the videos to
var parentElement = document.getElementById('videoContainer');

// Create and configure video elements
for (var i = 0; i < 5; i++) {
  // Create a new <video> element
  var videoElement = document.createElement('video');

  // Set the source and other attributes for the video
  videoElement.src = videoSources[i];
  videoElement.controls = false;
  videoElement.className = 'video-class-'+i;
  videoElement.style.width="200px";
  videoElement.style.height="200px";
  videoElement.style.backgroundColor="grey";

  // Append the video element to the parent element
  parentElement.appendChild(videoElement);

  // Add event listeners to the video element
  //videoElement.addEventListener('focus', handleFocus);
  videoElement.addEventListener('mouseleave', handleMouseLeave);
  videoElement.addEventListener('mouseenter', handleMouseEnter);
}
function handleFocus(event) {
  var videoElement = event.target;
  videoElement.play();
  videoElement.controls = true;
  // Perform additional actions when the video gains focus
}
function handleMouseEnter(event) {
  var videoElement = event.target;
   videoElement.play();
   videoElement.controls = true;
  videoElement.style.width="250px";
  videoElement.style.height="250px";
  // Perform additional actions when the video loses focus
}
function handleMouseLeave(event) {
  var videoElement = event.target;
  videoElement.pause();
  videoElement.controls = false;
  videoElement.style.width="200px";
  videoElement.style.height="200px";
  // Perform additional actions when the video loses focus
}*/
//jq
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
    var des;
    var names;
    function video(){
      //var names=JSON.parse(name);
      //var des=JSON.parse(des);
      des='<?php echo $desc ?>';
      names='<?php echo $video ?>';
      var descrip=JSON.parse(des);
      var videon=JSON.parse(names);
      // Example: Accessing the first element of the array
          // Parent element to append the videos to
          // Create and configure video elements
          for (var i = 0; i < 7; i++){
            // Create a new <video> element
            var holder=document.createElement('div');
            var videoElement = document.createElement('video');
            var description = document.createElement('label');
            // Set the source and other attributes for the video
            holder.style.width='350px';
            holder.style.height='250px';
            holder.style.display='inline';
            holder.style.boxShadow='box-shadow:0 5px 40px rgba(0,0,0,.30)';
            videoElement.src = './src/'+videon[i];
            videoElement.controls = false;
            videoElement.className = 'video-class-'+i;
            videoElement.style.width='350px';
            videoElement.style.zIndex='10';
            videoElement.style.height='220px';
            //videoElement.style.position='absolute';
            description.style.width="340px";
            description.style.display="inline-block";
            description.style.marginLeft="-340px";
            description.style.marginTop="20px";
            description.innerHTML=descrip[i];
            videoh.appendChild(holder);
            holder.appendChild(videoElement);
            holder.appendChild(description);
            //a.appendChild(videoElement);
            // Add event listeners to the video element
            //videoElement.addEventListener('focus', handleFocus);
            //videoElement.addEventListener('mouseleave', handleMouseLeave);
            //videoElement.addEventListener('mouseenter', handleMouseEnter);
          }
          function handleFocus(event) {
            var videoElement = event.target;
            videoElement.play();
            videoElement.controls = true;
            videoElement.style.position = 'absolute';
          }
          function handleMouseEnter(event) {
            var videoElement = event.target;
             videoElement.play();
             videoElement.controls = true;
             videoElement.style.paddingLeft='25px';
            videoElement.style.width='205px';
            videoElement.style.height='205px';
          }
          function handleMouseLeave(event) {
            var videoElement = event.target;
            videoElement.pause();
            videoElement.controls = false;
            videoElement.style.width='200px';
            videoElement.style.height='200px';
          }
          var v=document.querySelector('.video-class-0');
            v.style.borderTopLeftRadius="10px";
  }