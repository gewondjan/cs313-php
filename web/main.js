var divContent = {
    me: {
        image: "ryan.PNG",
        imageAltText: "Picture of Ryan Gewondjan",
        text: "My name is Ryan Gewondjan. I am from Brentwood, California.<br> I am a dreamer, a coder and I love to have fun."
    },
    dreams: {
        image: "lightbulb.jpg",
        imageAltText: "Picture of a Lightbulb",
        text: "Inventors of history have always caught my attention. I will one day invent something, or come up with a new idea. My career in computer science is a step in that direction."
    }, 
    code: {
        image: "code.jpg",
        imageAltText: "Picture of code",
        text: "My favorite part of any class is learning the code. I am fascinated with it. So far I have worked with Java, Javascript, Python, C++, C#, Elisp, and SQL."
    },
    fun: {
        image: "innout.jpg",
        imageAltText: "Picture of Innout Burger",
        text: "I love having fun! It keeps me feeling alive. Eating at Innout Burger, running, and spending time with friends and family are some of my favorite pasttimes."
    },
}

function makeTitleBold() {
    $(".options").hover(function(){
        $(this).find(".option-titles").attr("style", "font-size: 3.5em; font-weight: bold;");
    }, function() {
        $(this).find(".option-titles").attr("style", "");
    });
}

function bringInContent() {
    $(".options").click(function() {
        var name = $(this).find(".option-titles").attr("name");
        $("#image").attr("src", divContent[name].image);
        $("#image").attr("alt", divContent[name].imageAltText);
        $("#descriptive-text").html(divContent[name].text);
    });
}

$(document).ready(function(){
    makeTitleBold();
    bringInContent();
});





