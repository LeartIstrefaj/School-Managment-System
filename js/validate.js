function validate(){
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var message = document.getElementById("message").value;
    var error_message = document.getElementById("error_message");
    
    error_message.style.padding = "10px";
    // error_message.style.color = "red";
    
    var text;
    if(name.length < 5){
      text = "Please enter valid name";
      error_message.innerHTML = text;

      return false;
    }
    
    if(email.indexOf("@") == -1 || email.length < 6){
      text = "Please enter valid email";
      error_message.innerHTML = text;
      return false;
    }
    if(message.length <= 50){
      text = "Please enter more than 50 characters";
      error_message.innerHTML = text;
      return false;
    }
    alert("Sent successfully!");
    return true;
  }