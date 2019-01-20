function makeTitleBold() {
    $(".options").hover(function(){
       // alert("hover actually workds");
        $(this).find(".option-titles").attr("style", "font-size: 3.5em; font-weight: bold;");
    }, function() {
        $(this).find(".option-titles").attr("style", "");
    });
}


function bringInContent() {
    $(".options").click(function() {
        var name = $(this).find(".option-titles").attr("name");
        var filename = name + ".php";
        var phpString = `<?php include '${filename}'; ?>`;
        $("#presentation-banner").html(phpString);
         alert(phpString);
    });
}

$(document).ready(function(){
    makeTitleBold();
    bringInContent();
});



