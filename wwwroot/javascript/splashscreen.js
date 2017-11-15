// Script to hide the gameTitle and startButton after "Start" button has been clicked
$(document).ready(function(){
    $("#startButton").click(function(){
        $("#gameTitle").hide();
        $("#startButton").hide();
        $("#menuBar").hide();
        $("#menu").hide();
        document.getElementById("splashScreen").style.backgroundColor = "transparent";
        $("#pcInstructions").hide();
        $("#mobileInstructions").hide();
    });
});