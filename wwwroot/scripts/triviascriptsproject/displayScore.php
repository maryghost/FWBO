<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><?php
	session_start();
	
	
	if (isset($_POST['submitAnswer']))
	{
		if (isset($_SESSION['numCorrect']))
			$_SESSION['numCorrect'] += $_POST['scoreIncrement'];
		else
			$_SESSION['numCorrect'] = $_POST['scoreIncrement'];
		

		$_SESSION['explain'] = "Q: ".$_SESSION['questionText']. 
							"<p>The correct answer is <br />" . $_SESSION['questionExplanation']."</p>
							
						   <p>You have answered " . $_SESSION['numCorrect'] . " questions correctly.<br />
							Explanation: ". $_SESSION['Explanation'] ."</p>";
		   
		$_SESSION['question']++;
				
		header("Location:displayScore.php");
		//header("Location:play_triviaORIGINAL.js");
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
	<title> Fly with Butch O'Hare </title>
</head>

<body class="body">
<div style="width:100%;margin:0 auto;">
	<div class="container">
		<!------------------ Sidebar REMOVED by GSS 6-18-18------------------->
		
		<!----------         Content       ---------->
		<div id="content">
			<div id="logo-header">
				<img src="http://www.flywithbutchohare.com/images/fwb_header.jpg" alt="Fly with Butch O'Hare" >
			</div>
			
			<!----------       Page Content      ---------->
			<div id="page_content">
				<div class="message">
				<h1>Airport Trivia</h1>
		<!-- ANSWER CONTENT HERE --> 

		<form method = 'post' action = '../../Game_Trivia.php' id= 'quiz' name='frmQuiz' >
			<?php
				if (isset($_SESSION['explain']))
					echo $_SESSION['explain'];
			?>
			<p><input type='submit' class='button' value='Next' id='next' name = 'next' ></p>
		</form>
        
        	
		</div>
			</div>
			
			<!------------------ Social Media REMOVED by GSS 6-18-18------------------->
			
		</div>
		
		<div style="clear:both;"></div>
		
	</div>
	
	<!------------------ Footer REMOVED by GSS 6-18-18------------------->
	
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