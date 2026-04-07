$(document).ready(function(){
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');

    if (errorParam === 'email_exists'){
        $("#notification").html('<div class="error">Email already exists. Please choose a different email.</div>');
    } else if (errorParam === 'registered') {
        $("#notification").html('<div class="success">You are successfully registered. Please login.</div>');
    }

    // Clear the query string to prevent message from showing again on refresh
    if (history.pushState) {
        var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.pushState({path:newUrl}, '', newUrl);
    }
});
