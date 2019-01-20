function makeTitleBold() {
    $(".options").hover(function(){
       // alert("hover actually workds");
        $(this).find(".option-titles").attr("style", "font-size: 3.5em; font-weight: bold;");
    }, function() {
        $(this).find(".option-titles").attr("style", "");
    });
}


$(document).ready(function(){
    makeTitleBold();
});



