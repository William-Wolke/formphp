const passwordConfirmation = document.getElementById("password2")/*$('#password2')*/;

passwordConfirmation.setCustomValidity("Password invalid");
$('#createSubmit')[0].onclick = validatePassword;

function validatePassword() {

var uName = $('#username').val();
var pWord = $('#password').val();
var pWord2 = $('#password2').val();

  if (pWord == "" || pWord != pWord2) {
    passwordConfirmation.setCustomValidity("Password invalid");
  } else {
    passwordConfirmation.setCustomValidity("");
  }
}

