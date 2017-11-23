<?php
	session_start();
	
	if (isset($_POST['submitAnswer']))
	{
		if (isset($_SESSION['numCorrect']))
			$_SESSION['numCorrect'] += $_POST['scoreIncrement'];
		else
			$_SESSION['numCorrect'] = $_POST['scoreIncrement'];
		
		$_SESSION['explain'] = "<p>The correct answer is <br />" . $_SESSION['questionExplanation'] .
			       "</p><p>You have answered " . $_SESSION['numCorrect'] . " questions correctly.</p>";
				   
		$_SESSION['question']++;
		
		header("Location:displayScore.php");
	}
	else if (isset($_POST['reset']))
	{
		$_SESSION['question'] = 1;
		$_SESSION['numCorrect'] = 0;
		header("Location:../../Game_Trivia.php?next=".$_SESSION['question']);
	}
	//else
	//	header("Location:../../Game_Trivia_Version2.php");

?>
<html>

<head>
	<link rel="stylesheet" href="../../css/layout.css">
	<link rel="stylesheet" href="../../css/play.css">
	<link rel="stylesheet" href="../../css/web fonts/komikatitle_regular_macroman/stylesheet.css" type="text/css" charset="utf-8" />
	<link rel="stylesheet" href="../../css/web fonts/roboto_boldcondensed_macroman/stylesheet.css" type="text/css" charset="utf-8" />
	<link rel="stylesheet" href="../../css/web fonts/roboto_condensed_macroman/stylesheet.css" type="text/css" charset="utf-8" />
	<link rel="stylesheet" href="../../css/web fonts/roboto_regular_macroman/stylesheet.css" type="text/css" charset="utf-8" />
	
	<title> Fly with Butch O'Hare </title>
</head>

<body>


		<!----------     Navigation Bar      ---------->
	<a id="showBtn" class="menuToggle" href="#">Show</a>
	<div id="menu" class="main-nav">
		<a id="hideBtn" class="menuToggle" href="#menu">	Collapse	</a>
		
		<a href="Index.html">
			<img src="../../images/navMenu/icon_home.png" alt="Home">			</a>
		<a href="Index.html" class="menuLink">		Home				</a>
		
		<a href="Play.html">
			<img src="../../images/navMenu/icon_game.png" alt="Play">			</a>
		<a href="Play.html" class="menuLink">		Play				</a>
		<!-- 
		<a href="Filter.html">
			<img src="images/navMenu/icon_filter.png" alt="home">		</a>
		<a href="Filter.html" class="menuLink">		Filter				</a>
		 -->
		<a href="Score.html">
			<img src="../../images/navMenu/icon_trophy.png" alt="home">		</a>
		<a href="Score.html" class="menuLink">		Score				</a>
		
		<a href="Map.html">
			<img src="../../images/navMenu/icon_map.png" alt="home">			</a>
		<a href="Map.html" class="menuLink">			Map				</a>
		
		<a href="Credits.html">
			<img src="../../images/navMenu/icon_home.png" alt="home">			</a>
		<a href="Credits.html" class="menuLink">		Credits			</a>
	</div>

	
	<!----------          Container         ---------->
	<div class="container-wrap">
	<div class="container">
		<!----------         Header        ---------->
<div id="content">
		<div id="page_content"><div class="message">
        <h1>Airport Trivia</h1>		<div id="content">
		<form method = 'post' action = '../../Game_Trivia.php' id= 'quiz' name='frmQuiz' >
			<?php
				if (isset($_SESSION['explain']))
					echo $_SESSION['explain'];
			?>
			<p><input type='submit' class='button' value='Next' id='next' name = 'next' ></p>
		</form>
		</div>

		<!----------         Footer       ----------->
		<div id="footer">
			<!--<a id="cda_logo" href="http://www.flychicago.com">
				<img src="images/social/cda_logo.png"></a>-->
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
			</div>
		</div>
	</div>
</div>
</body>

	

</html>