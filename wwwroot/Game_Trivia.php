<?php

	session_start();
	if (!isset($_SESSION['question']))
		$_SESSION['question'] = 0;
	
	if (isset($_POST['next']))
	{
		//$_SESSION['question']++;
		header("Location:Game_Trivia.php?next=".$_SESSION['question']);
	}

?>

<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/play_trivia.css">
	<link rel="stylesheet" href="css/webfonts/komikatitle_regular_macroman/stylesheet.css" type="text/css" />
	<link rel="stylesheet" href="css/webfonts/roboto_boldcondensed_macroman/stylesheet.css" type="text/css" />
	<link rel="stylesheet" href="css/webfonts/roboto_condensed_macroman/stylesheet.css" type="text/css" />
	<link rel="stylesheet" href="css/webfonts/roboto_regular_macroman/stylesheet.css" type="text/css" />
	<style>

.message li 	{list-style:none;
}
</style>
	<script>
		var isReset = false;
		function validateSelection()
		{
			if (isReset) 
				return true;
			else
			{
				// if we are past the end of the questions OR we have an explanation to display, then skip validation.
				if (<?php echo $_SESSION['question'] ?> > 10)
					return true;
			}
			
			var ok = false;
			var answers = document.getElementsByName('answer');
			for (var i = 0; i < answers.length; i++)
			{
				if (answers[i].checked)
				{
					ok = true;
				}
			}
			
			if (!ok)
				alert("Please select an answer choice.");
			
			return ok;
		}
	</script>
	<title>Fly with Butch O'Hare</title>
	</head>

	<body><!--     LOGIN    REMOVED LOGIN MLP   
<div> <a id="loginBtn" href="Login.html"> Log in </a> -->
      
      <!--     Navigation Bar   REMOVED SHOW TOGGLE MLP   
      <a id="showBtn" class="menuToggle" href="#">Show</a>--> 
      


      

    <div class="container" style="background-color:#ffffff;"> <div class="sidebar">
      <div id="menu" class="main-nav"> <!-- CUT COLLAPSE MLP    <a id="hideBtn" class="menuToggle" href="#menu"> Collapse </a> --><a href="Index.html"> <img src="http://www.flywithbutchohare.com/images/navMenu/icon_home.png" alt="Home"> </a> <a href="Index.html" class="menuLink"> Home </a> <a href="Play.html"> <img src="http://www.flywithbutchohare.com/images/navMenu/icon_game.png" alt="Play"> </a> <a href="Play.html" class="menuLink"> Play </a> 
    <!-- 
		<a href="Filter.html">
			<img src="images/navMenu/icon_filter.png" alt="home">		</a>
		<a href="Filter.html" class="menuLink">		Filter				</a>
		 --> 
    <a href="Score.html"> <img src="http://www.flywithbutchohare.com/images/navMenu/icon_trophy.png" alt="home"> </a> <a href="Score.html" class="menuLink"> Score </a> <a href="Map.html"> <img src="http://www.flywithbutchohare.com/images/navMenu/icon_map.png" alt="home"> </a> <a href="Map.html" class="menuLink"> Map </a> <a href="Credits.html"> <img src="http://www.flywithbutchohare.com/images/navMenu/icon_home.png" alt="home"> </a> <a href="Credits.html" class="menuLink"> Credits </a> </div>
      <!-- menu -->  </div>     <!--          Closed Sidear   MLP      -->
          <!--         Header        -->
     
<div id="logo-header"><img src="images/fwb_header.jpg" alt="Fly with Butch O'Hare" width="900" height="295" /></div>


          
          <!--         Content       --> 
          <!--<div id="content">
		
			<div id= 'quiz'>
				<input type='button' class='button' value='Next' id='next'><a href='#'></a></div> 
				<input type='button' class='button' value='prev' id='prev'><a href='#'></a></div>
			</div>
			<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>          
			<script type='text/javascript' src="javascript/play_trivia.js"> </script>
			
		</div>-->
		
		<div id="content">
		<div id="page_content"><div class="message">
        <h1>Airport Trivia</h1>
			<?php
				if (!isset($explain))
					include('scripts/triviascriptsproject/TriviaSelect.php'); 
			?>
	<script>
		function checkAnswer(isReset)
		{
			if (isReset || !validateSelection()) return;
			
			var correctAnswer = "<?php echo $_SESSION['questionAnswer']; ?>";
			
			var answerChoices = document.getElementsByName('answer');
			
			for (var i = 0; i < answerChoices.length; i++)
			{
				if (answerChoices[i].checked && answerChoices[i].value == correctAnswer)
				{
					document.frmQuiz.scoreIncrement.value = 1;
					//alert("CORRECT!");
				}
			}
		}
		
		function resetGame()
		{
			isReset = true;
		}
	</script>

		<form method = 'post' action = 'scripts/triviascriptsproject/displayScore.php' id= 'quiz' name='frmQuiz' onsubmit='return validateSelection();' >
			<input type="hidden" name="scoreIncrement" value="0" />
			<?php
				if (isset($explain))
					echo $explain;
				else
				{
					if ($_SESSION['question'] <= 10)
						echo "<input type='submit' class='button' value='Submit Answer' id='submitAnswer' name='submitAnswer' ".
					         " onclick='checkAnswer(false);'>";
					else
						echo '<input type="submit" class="button" value="Play Again" id="reset" name="reset" onclick="checkAnswer(true);">';
				}
			?>
		</form>
	</div> <!-- message -->
        </div>  <!-- page content MLP, closed--> 

		</div> <!-- content -->

		<!--         Footer       -->
		<div id="footer">
			<a id="cda_logo" href="http://www.flychicago.com">
				<img src="images/social/cda_logo.png"></a>
			<div class="social">
				<img src="images/social/share_hashtag.png"><br>
				<a href="https://twitter.com/fly2ohare" target="_blank">
					<img src="images/social/share_twitter.png"></a>
				<a href="https://www.instagram.com/flyohare/" target="_blank">
					<img src="images/social/share_instagram.png"></a>
				<a href="https://www.facebook.com/fly2ohare/" target="_blank">
					<img src="images/social/share_facebook.png"></a>
				<a href="https://www.pinterest.com/flychicago/" target="_blank">
					<img src="images/social/share_pinterest.png"></a>
			</div> <!-- social -->
		</div> <!-- footer -->
</div> <!-- container -->
</body>
</html>