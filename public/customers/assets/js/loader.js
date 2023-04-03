// Show the loading spinner when the page starts loading
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("loading").style.display = "block";
});

// Hide the loading spinner when the page finishes loading
window.addEventListener("load", function () {
    document.getElementById("loading").style.display = "none";
});

function pageLoad(sender, args) {
    var prm = Sys.WebForms.PageRequestManager.getInstance();
    prm.add_beginRequest(BeginRequestHandler);
    prm.add_endRequest(EndRequestHandler);
}

function BeginRequestHandler(sender, args) {
    document.getElementById("body").style.visibility = 'hidden';
    document.getElementById("loading").style.visibility = 'visible';
}

function EndRequestHandler(sender, args) {
    document.getElementById("body").style.visibility = 'visible';
    document.getElementById("loading").style.visibility = 'hidden';
}
$(document).ready(function () {
    $('form').submit(function () {
        $('#loading').fadeIn();
    });
});
