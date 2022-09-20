function shaddow() {
    document.getElementById("form").style.boxShadow = " 0px 10px 21px -3px rgba(0, 0, 0, .3)";
    
    
    setTimeout(function() {
    document.getElementById("form").style.boxShadow = " 0px 8px 17px -5px rgba(0, 0, 0, .3)";
}, 10000);
}

function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}
