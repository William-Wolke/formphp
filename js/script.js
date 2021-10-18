var uName = document.forms['username'].value;
var pWord = document.forms['notpassword'].value;
var pWord2 = document.forms['notpassword2'].value;

const passwordConfirmation = document.forms["notpassword2"];

function validatePassword() {
  if (pWord == null || pWord != pWord2) {
    passwordConfirmation.setCustomValidity("Password invalid");
  } else {
    passwordConfirmation.setCustomValidity("");
  }
}

document.getElementsByName("submit")[0].onclick = validatePassword;