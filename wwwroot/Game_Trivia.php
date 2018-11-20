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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118827552-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-118827552-1');
</script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="http://www.flywithbutchohare.com/css/layout.css"  type="text/css" charset="utf-8">
	<link rel="stylesheet" href="http://www.flywithbutchohare.com/css/fonts.css" type="text/css" charset="utf-8">
	
	<link href="css/fwb2018.css" rel="stylesheet" type="text/css">
<title> Fly with Butch O'Hare </title>
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
    
    	<style>

.message li 	{list-style:none;
}
</style>
</head>

<body class="body">
<div style="width:100%;margin:0 auto;">
	<div class="container">
		<!------------------ Sidebar GSS Removed 6-18-18------------------->
		
		
		<!----------         Content       ---------->
		<div id="content">
			<div id="logo-header">
				<img src="http://www.flywithbutchohare.com/images/fwb_header.jpg" alt="Fly with Butch O'Hare" >
			</div>
			
			<!----------       Page Content      ---------->
			<div id="page_content">
				<div class="message">
<h1>Airport Trivia</h1>
		<!-- QUESTION CONTENT HERE --> 

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
            
            		<!-- END QUESTION CONTENT HERE --> 

            		</div>
			</div>
			
			<!------------------ Social Media REMOVED 6-19-18 by GSS ------------------->
			
		</div>
		
		<div style="clear:both;"></div>
		
	</div>
	
	<!------------------ Footer REMOVED 6-19-18 by GSS ------------------->
	    <div id="back"> <a href="index.html"><img src="images/back_btn.png" alt="Back button"></a></div>

</div>
</body>
	<script>
		printPlay();
		function getCookie(cname){
			var name = cname + "=";
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			for (var i = 0; i < ca.length; i++){
				var c = ca[i];
				while (c.charAt(0) == ' '){
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0){
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}
		
		function printPlay(){
			var myCookie = getCookie("PHPSESSID");
			
			if (myCookie == ''){
				//alert("cookie is null");
				return;
			}
			else
			{
				//alert(document.cookie);
				
				document.getElementById("disclaimer").innerHTML = "<h3>Disclaimer:</h3>\r\n\r\nThese videos and images are for your personal use only, and cannot be used for any commercial purpose. The use or duplication of these images by any agency, company, or business entity other than the City of Chicago, without express prior written permission from the City of Chicago's Department of Aviation, is strictly prohibited.\r\n\r\nWhile all reasonable precautions are taken to secure this site, CDA, Unison Consulting, and its affiliates will not assume responsibility or liability for any damages to personal property resulting from virus infection, destructive code, or other information technology related issues or problems (such as hacking, spam, spyware, etc.) and we encourage you to have appropriate and up to date anti-virus software.";
			}
		}
	</script>
</html>