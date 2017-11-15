$(document).ready(function(){
    $("#startButton").click(function(){
        var sec = 10;

        setInterval(function() {
          document.getElementById("timer").innerHTML = sec;
          sec--;

          if (sec <= 0) {
            document.getElementById("splashScreen").style.backgroundColor = "lightblue";
            $("#hud").hide();
            $("#hud2").hide();
            $("#gameTitle").text("Game over!");
            $("#gameTitle").show();
            window.clearTimeout()
            $("#startButton").text("Play Again!");
            $("#startButton").show();
          }
        },1000);
    });
});
