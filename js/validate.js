function validate() {
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var message = document.getElementById("message").value;
  var error_message = document.getElementById("error_message");

  error_message.style.padding = "10px";
  // error_message.style.color = "red";

  var text;
  if (name.length < 5) {
    text = "Please enter valid name";
    error_message.innerHTML = text;

    return false;
  }

  if (email.indexOf("@") == -1 || email.length < 6) {
    text = "Please enter valid email";
    error_message.innerHTML = text;
    return false;
  }
  if (message.length <= 50) {
    text = "Please enter more than 50 characters";
    error_message.innerHTML = text;
    return false;
  }
  alert("Sent successfully!");
  return true;
}


function login() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var error_message = document.getElementById("error_message");

  error_message.style.padding = "10px";

  var text;

  if (email.indexOf("@") == -1 || email.length < 6) {
    text = "Please enter valid email";
    error_message.innerHTML = text;
    return false;
  }
  if (password.length < 4) {
    text = "Password must be at last 4 characters";
    error_message.innerHTML = text;
    return false;
  }
  if (password.length > 8) {
    text = "Password must be at most 8 characters";
    error_message.innerHTML = text;
    return false;
  }
}


function signup() {
  var fistName = document.getElementById("fistName").value;
  // var lastName = document.getElementById("lastName").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var error_message = document.getElementById("error_message");

  error_message.style.padding = "10px";

  var text;
  if (fistName.trim().length <= 3) {
    text = "Please enter valid First Name";
    error_message.innerHTML = text;
    return false;
  }
  // if (lastName.trim().length <= 4) {
  //   text = "Please enter valid Last Name";
  //   error_message.innerHTML = text;
  //   return false;
  // }
  if (email.indexOf("@") == -1 || email.length < 6) {
    text = "Please enter valid email";
    error_message.innerHTML = text;
    return false;
  }
  if (password.length < 4) {
    text = "Password must be at last 4 characters";
    error_message.innerHTML = text;
    return false;
  }
  if (password.length > 8) {
    text = "Password must be at most 8 characters";
    error_message.innerHTML = text;
    return false;
  }
}