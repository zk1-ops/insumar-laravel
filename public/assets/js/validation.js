function validar() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    email_return = ValidateEmail(email)
    password_return = ValidatePassowrd(password)


    return email_return && password_return
}

function ValidateEmail(input) {

    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    let pErrorMail = document.getElementById('error_mail');

    if( input == '' ){

        pErrorMail.innerHTML = "<p>Este es un campo obligatorio</p>";
    }  
    else if (input.match(validRegex)) {
     
        document.form1.text1.focus();
    
        return true;
    
      } else {
  
        pErrorMail.innerHTML = "<p>No es un E-mail valido</p>";
  
        document.form1.text1.focus();
  
        return false;
  
    }
  
  }


  function ValidatePassowrd(input) {

    let pErrorPassword = document.getElementById('error_password');

    if( input == '' ){

        pErrorPassword.innerHTML = "<p>Este es un campo obligatorio</p>";
    }  
  
  }