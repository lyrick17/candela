
let allowSubmit = false;


function captchafilled() { // function when user has done the captcha
    allowSubmit = true;
    document.getElementById("formcaptcha").value = "filled";

}

function captchaexpired() { //   when the captcha expired, not allowing the user to proceed on process
    allowSubmit = false;
    document.getElementById("formcaptcha").value = "";
}


// for user conveience, if captcha is not checked, form will not be submitted, otherwise, continue process
// client side validation
document.getElementById("formstyle").onsubmit = function(e) {
    if (allowSubmit) return true;

    e.preventDefault();

    document.getElementById("captcha_error").innerHTML = "^ Please fill up the Captcha";

}