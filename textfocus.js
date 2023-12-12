function pnotm(){
    mat1.style.visibility="visible";
}
window.onload = function() {
    var inputElements = document.getElementsByTagName('input');

    for (var i = 0; i < inputElements.length; i++) {
        if (inputElements[i].type === "text") {
            inputElements[i].value = ''; // Clear the value
        }
    }
}