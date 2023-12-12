<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginstyle.css">
    <script src="jquery-3.7.0.min.js"></script>
    <style>
        .ph{z-index: 1;background-color:white;}
        input{z-index: 2;}
    </style>
</head>
<body style="background: #cdcdff;">
<div class="loginh" style="background-color:white;">
        <div>
            <p style="margin-top: 30px;font-size: 25px;background-color:white;">Tube Stream</p>
        </div>
<div id="reg" style="background-color:white;">
        <form method="POST" action="uexist.php" style="background-color:white;">
            <p style="font-size: 25px;background-color:white;">Register</p>
            <div style="margin-top: 30px;background-color:white;">
                <input class="rname" type="text" name="rname" required>
                <p class="reh ph">Enter your Name</p>
            </div>
            <div style="margin-top: 30px;background-color:white;">
                <input class="remail" type="email" name="remail" required>
                <p class="reh1 ph">Enter your Email</p>
            </div>
            <p class="mat" style="color: red;margin-left: -100px;height: 5px;margin-top: 0px;visibility:hidden;background-color:white;">Email already exist</p>
            <div style="margin-top: 30px;background-color:white;">
                <input class="rpass" type="password" name="rpass" required>
                <p class="rph ph">Enter password</p>
            </div>
            <p class="mat1" style="color: red;margin-left: -100px;height: 5px;margin-top: 0px;visibility:hidden;background-color:transparent;">Password does not match</p>
            <div style="margin-top: 30px;background-color:white;">
                <input class="rpass1" type="password" name="rcpass" required>
                <p class="rph1 ph">Confirm password</p>
                <p class="emptmat" style="color: red;margin-left: -100px;height: 5px;margin-top: 0px;visibility:hidden;background-color:white;">Enter password</p>
            </div>
            <div style="cursor: pointer;background-color:white;" class="check"><input class="checkrp" type="checkbox"><span style="background-color:white;" class="rcheck">Show password</span></div>
            <div style="background-color:white;">
                <input id="b1" style="margin-top:20px;width: 80px;height: 30px;margin-right: 30px;border-color: rgb(238, 238, 238);background-color:white;" type="button" value="Back" onclick="">
                <input id="Signup" style="margin-top:-20px;width: 80px;height: 30px;margin-left: 30px;border-color: rgb(238, 238, 238);background-color:white;" type="button" value="Sign Up" name="login" role="submit">
            </div>
        </form>
        </div>
        </div>
        <script>
const reg=document.getElementById('reg');
const rname=document.querySelector(".rname");
const reh=document.querySelector(".reh");
const mat1=document.querySelector('.mat1');
const b1=document.getElementById('b1');
const signup=document.getElementById('Signup');
const rpass=document.querySelector(".rpass");
const rcheck=document.querySelector('.rcheck');
const emptmat=document.querySelector('.emptmat');
rcheck.addEventListener('click', function(){
    checkrp.checked = !checkrp.checked;
})
const checkrp=document.querySelector('.checkrp');
checkrp.addEventListener('change',() => {
    if(checkrp.checked){
        rpass.setAttribute("type","text");
        rpass1.setAttribute("type","text");
    }
    else{
        rpass.setAttribute("type","password");
        rpass1.setAttribute("type","password");
    }
})
rcheck.addEventListener('click', () => {
    if(checkrp.checked){
        rpass.setAttribute("type","text");
        rpass1.setAttribute("type","text");
    }
    else{
        rpass.setAttribute("type","password");
        rpass1.setAttribute("type","password");
    }
})
signup.addEventListener('click',() => {
    if(rpass.value==rpass1.value){
        mat1.style.visibility='hidden';
    }else if(rpass=="" && rpass==null && rpass1=="" && rpass1==null){
        emptmat.style.visibility="visible";
    }
})
b1.addEventListener('click',() => {
    window.location.href="login.php";
})
rname.addEventListener('keyup',() => {
        reh.style.fontSize="15px";reh.style.marginTop="-45px";reh.style.position="absolute";reh.style.zIndex="2";reh.style.width="120px";reh.style.backgroundColor="white";
        if(rname.value==""){
            reh.style.fontSize="20px";reh.style.marginLeft="70px";reh.style.marginTop="-28px";reh.style.zIndex="1";reh.style.width="auto";reh.style.backgroundColor="white";
        }
});
rname.addEventListener('focusin',() => {
    if (rname.value!=""){
        reh.style.fontSize="15px";reh.style.marginTop="-45px";reh.style.position="absolute";reh.style.zIndex="2";reh.style.width="120px";reh.style.backgroundColor="white";
    }
    else{
        reh.style.fontSize="20px";reh.style.marginLeft="70px";reh.style.marginTop="-28px";reh.style.zIndex="1";reh.style.width="auto";reh.style.backgroundColor="white";
    }
})
rname.addEventListener('focusout',() => {
    if (rname.value!=""){
        reh.style.fontSize="15px";reh.style.marginTop="-45px";reh.style.position="absolute";reh.style.zIndex="2";reh.style.width="120px";reh.style.backgroundColor="white";
    }
    else{
        reh.style.fontSize="20px";reh.style.marginLeft="70px";reh.style.marginTop="-28px";reh.style.zIndex="1";reh.style.width="auto";reh.style.backgroundColor="white";
    }
})
const remail=document.querySelector(".remail");
const reh1=document.querySelector(".reh1");
remail.addEventListener('keyup',() => {
        reh1.style.fontSize="15px";reh1.style.marginTop="-45px";reh1.style.position="absolute";reh1.style.zIndex="2";reh1.style.width="120px";reh1.style.backgroundColor="white";
        if(remail.value==""){
            reh1.style.fontSize="20px";reh1.style.marginLeft="70px";reh1.style.marginTop="-28px";reh1.style.zIndex="1";reh1.style.width="auto";reh1.style.backgroundColor="white";
        }
});
remail.addEventListener('focusin',() => {
    if (remail.value!=""){
        reh1.style.fontSize="15px";reh1.style.marginTop="-45px";reh1.style.position="absolute";reh1.style.zIndex="2";reh1.style.width="120px";reh1.style.backgroundColor="white";
    }
    else{
        reh1.style.fontSize="20px";reh1.style.marginLeft="70px";reh1.style.marginTop="-28px";reh1.style.zIndex="1";reh1.style.width="auto";reh1.style.backgroundColor="white";
    }
})
remail.addEventListener('focusout',() => {
    if (remail.value!=""){
        reh1.style.fontSize="15px";reh1.style.marginTop="-45px";reh1.style.position="absolute";reh1.style.zIndex="2";reh1.style.width="120px";reh1.style.backgroundColor="white";
    }
    else{
        reh1.style.fontSize="20px";reh1.style.marginLeft="70px";reh1.style.marginTop="-28px";reh1.style.zIndex="1";reh1.style.width="auto";reh1.style.backgroundColor="white";
    }
})
rpass.addEventListener('keyup',() => {
        rph.style.fontSize="15px";rph.style.marginTop="-45px";rph.style.position="absolute";rph.style.zIndex="2";rph.style.width="120px";rph.style.backgroundColor="white";
        mat1.style.visibility="hidden";
        if(rpass.value==""){
            rph.style.fontSize="20px";rph.style.marginLeft="70px";rph.style.marginTop="-28px";rph.style.zIndex="1";rph.style.width="auto";rph.style.backgroundColor="white";
        }
});
const rph=document.querySelector(".rph");
rpass.addEventListener('focusin',() => {
    if (rpass.value!=""){
        rph.style.fontSize="15px";rph.style.marginTop="-45px";rph.style.position="absolute";rph.style.zIndex="2";rph.style.width="120px";rph.style.backgroundColor="white";
        mat1.style.visibility="hidden";
        emptmat.style.visibility="hidden";
    }
    else{
        rph.style.fontSize="20px";rph.style.marginLeft="70px";rph.style.marginTop="-28px";rph.style.zIndex="1";rph.style.width="auto";rph.style.backgroundColor="white";
    }
})
rpass.addEventListener('focusout',() => {
    if (rpass.value!=""){
        rph.style.fontSize="15px";rph.style.marginTop="-45px";rph.style.position="absolute";rph.style.zIndex="2";rph.style.width="120px";rph.style.backgroundColor="white";
        if(rpass.value==rpass1.value){
            mat1.style.visibility='hidden';
            signup.setAttribute("type","submit");
            console.log(sign.type)
        }
        else{
            mat1.style.visibility='visible';
        }
    }
    else{
        rph.style.fontSize="20px";rph.style.marginLeft="70px";rph.style.marginTop="-28px";rph.style.zIndex="1";rph.style.width="auto";rph.style.backgroundColor="white";
    }
})
const rpass1=document.querySelector(".rpass1");
const rph1=document.querySelector(".rph1");
rpass1.addEventListener('keyup',() => {
        rph1.style.fontSize="15px";rph1.style.marginTop="-45px";rph1.style.position="absolute";rph1.style.zIndex="2";rph1.style.width="120px";rph1.style.backgroundColor="white";
        mat1.style.visibility='hidden';
        if(rpass1.value==""){rph1.style.fontSize="20px";rph1.style.marginLeft="70px";rph1.style.marginTop="-28px";rph1.style.zIndex="1";rph1.style.width="auto";rph1.style.backgroundColor="white";}
});
rpass1.addEventListener('focusin',() => {
    if (rpass1.value!=""){
        rph1.style.fontSize="15px";rph1.style.marginTop="-45px";rph1.style.position="absolute";rph1.style.zIndex="2";rph1.style.width="120px";rph1.style.backgroundColor="white";
        mat1.style.visibility='hidden';
        emptmat.style.visibility="hidden";
    }
    else{
        rph1.style.fontSize="20px";rph1.style.marginLeft="70px";rph1.style.marginTop="-28px";rph1.style.zIndex="1";rph1.style.width="auto";rph1.style.backgroundColor="white";
    }
})
rpass1.addEventListener('focusout',() => {
    if (rpass1.value!=""){
        rph1.style.fontSize="15px";rph1.style.marginTop="-45px";rph1.style.position="absolute";rph1.style.zIndex="2";rph1.style.width="120px";rph1.style.backgroundColor="white";
        if(rpass.value==rpass1.value){
            mat1.style.visibility='hidden';
            signup.setAttribute("type","submit");
            console.log(sign.type)
        }
        else{
            mat1.style.visibility='visible';
        }
    }
    else{
        rph1.style.fontSize="20px";rph1.style.marginLeft="70px";rph1.style.marginTop="-28px";rph1.style.zIndex="1";rph1.style.width="auto";rph1.style.backgroundColor="white";
    }
})
        </script>
</body>
</html>