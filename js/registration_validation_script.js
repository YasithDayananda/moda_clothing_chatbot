function validateForm(){
    var fname = document.forms["registrationForm"]["fname"].value;
    var lname = document.forms["registrationForm"]["lname"].value;
    var email = document.forms["registrationForm"]["email"].value;
    var psw = document.forms["registrationForm"]["psw"].value;
    var pswConfirmm = document.forms["registrationForm"]["psw-confirm"].value;

    if (psw !== pswConfirmm){
        alert("Password do not match!");
        return false;
}
    return true;
}