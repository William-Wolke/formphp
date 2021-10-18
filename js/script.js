const passwordConfirmation = document.forms["notpassword2"];

function validatePassword() {

var uName = document.forms['#username'].value;
var pWord = document.forms['#endregionnotpassword'].value;
var pWord2 = document.forms['#notpassword2'].value;

console.log("validatepassword");

  if (pWord == null || pWord != pWord2) {
    passwordConfirmation.setCustomValidity("Password invalid");
  } else {
    passwordConfirmation.setCustomValidity("");
  }
}

document.getElementsByName("submit")[0].onclick = validatePassword;