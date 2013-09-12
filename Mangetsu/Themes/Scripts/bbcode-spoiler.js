//Spoiler
$(document).ready(function(){
    // Hide the "content" div.
    $("div.content").hide(); 
    // When clicked, toggle the "content" div.
    $("div.spoiler").click(function(){
        $(this).toggleClass("active").next().slideToggle(1800);
        return false; 
    });
});