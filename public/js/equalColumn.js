// Resizing Event Column
function equalHeight() {
    var column1 = document.getElementById("column1");
    var column2 = document.getElementById("column2");
    column2.style.height = column1.offsetHeight + "px";
};

$(document).ready(equalHeight());
var resizeTimer;
$(window).resize(function() {
    if (resizeTimer) {
        clearTimeout(resizeTimer);   // clear any previous pending timer
    }
     // set new timer
    resizeTimer = setTimeout(function() {
        resizeTimer = null;
        equalHeight();
    }, 1);  
});