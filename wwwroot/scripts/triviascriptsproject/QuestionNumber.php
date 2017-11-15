<html>
<head>
<?php
	//$pool = $_REQUEST["question"];
	//echo "Question " . $pool . "<br />";
?>
<title>Question <?php echo $_REQUEST["question"]; ?></title>
</head>
<body>
<h2>Question <?php echo $_REQUEST["question"]; ?></h2>
<p>Next question will be #<?php echo $_REQUEST["question"] + 1; ?>
<form method="get" action="QuestionNumber.php?question=<?php echo $_REQUEST["question"] + 1; ?>">
<input style="display:none" type="text" name="question" value="<?php echo $_REQUEST["question"] + 1; ?>" />
<input type="submit" value="Next Question" />
</form>
</body>
</html>
