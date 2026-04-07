window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    var footer = document.querySelector('footer');
    var scrollHeight = document.documentElement.scrollHeight;
    var clientHeight = document.documentElement.clientHeight;
    var scrollTop = window.scrollY || document.documentElement.scrollTop;

    // Adjust the 20 pixels as needed for when you want the footer to appear
    if (scrollHeight - scrollTop <= clientHeight + 20) {
        footer.style.display = "block";
    } else {
        footer.style.display = "none";
    }
}
