$(document).ready(function(){
   
    //onclick signup, hide login show register
    $("#signup").click(function(){
        $("#first").slideUp("slow", function(){
            $("#second").slideDown("slow");
        });
    });
    // reverse
    $("#signin").click(function(){
        $("#second").slideUp("slow", function(){
            $("#first").slideDown("slow");
        });
    });
    
});