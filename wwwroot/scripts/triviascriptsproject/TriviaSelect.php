<?php

	session_start();
	include('dbConnect.php');

	if($_SESSION["question"] < 1)
	$_SESSION["question"] = 1;
	
	$pool = $_SESSION["question"];
	
	$sql = "select count(*) as numQuestions from TriviaQuestionsExplanation where questionPool = ?;";
	$stmt = sqlsrv_prepare( $conn, $sql, array( &$pool) );
	sqlsrv_execute($stmt);
	
	if( $stmt === false ) 
	{
		$resp->message = print_r( sqlsrv_errors(), true);
	}
	else
	{
		$rows = sqlsrv_has_rows( $stmt );
		if ($rows === true) 
		{
			
			$row = sqlsrv_fetch_array($stmt);
			$numQuestions = $row["numQuestions"];;
			
			$selectedQuestion = rand(1, $numQuestions);

		$sql = "select * from TriviaQuestionsExplanation where questionPool = ? and questionNum = ?;";
		$stmt = sqlsrv_prepare( $conn, $sql, array( &$pool, &$selectedQuestion ) );
		sqlsrv_execute($stmt);

		
		$row = sqlsrv_fetch_array($stmt);
		$questionNum = $row["questionNum"];
		$question = $row["question"];
		$options =  array($row["option1"],
						  $row["option2"],
						  $row["option3"],
						  $row["option4"],
						  $row["option5"],
						  $row["option6"]);
					
		$_SESSION['questionText'] = $row["question"];

						$_SESSION["Explanation"] = $row["Explanation"];

		$_SESSION["questionAnswer"] = $row["questionAnswer"];
		$_SESSION["questionExplanation"] = $row["questionExplanation"];

		if ($pool <= 10) 
			$output = "<h2>Question " . $pool . ":</h2>";
		else
		{
			$pool = 0;
			$_SESSION['question'] = 0;
			$score = $_SESSION["numCorrect"];
			$_SESSION['numCorrect'] = 0;
			header("Location:trivia_end.php?score=$score");
			
			$output = "<h2>Thanks for playing!</h2>";
			$output .= "<p>You correctly answered " . $_SESSION['numCorrect'] . " out of 10 questions.</p>";
		}
		
		$output .= "<p>" . $question . "</p>";
		$output .= "<ul>";
		$count = count($options);
		for ($i = 0; $i < $count; $i++) 
		{
			if (trim($options[$i]) != "")
			{
				$output .= "<li><input type='radio' id='answer$i' name='answer' value='";
				$output .= ($i+1) . "' />" . $options[$i] . "</li>";
			}
		}
		$output .= "</ul>";
		
		echo $output;
		//echo "<script language='JavaScript'>";
		//echo "document.getElementById('question').innerHTML = '" . $output ."';";
		//echo "</script>";
		
		}
	}
?>