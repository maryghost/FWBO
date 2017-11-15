<?php
	include('dbConnect.php');

	// DEBUG
	echo "Getting question number from request...";
	$pool = $_REQUEST["question"];
	
	// DEBUG
	echo "Preparing first query...";
	
	$sql = "select * from TriviaQuestions where questionPool = ?;";
	$stmt = sqlsrv_prepare( $conn, $sql, array( &$pool) );
	sqlsrv_execute($stmt);

	if( $stmt === false ) 
	{
		$resp->message = print_r( sqlsrv_errors(), true);
	}
	else
	{
		// DEBUG
		echo "Seeing if we got rows...";
		
		$rows = sqlsrv_has_rows( $stmt );
		if ($rows === true) 
		{
			// DEBUG
			echo "Yep, we got rows!";
			
			$numQuestions = sqlsrv_num_rows( $stmt );			
			$selectedQuestion = rand(1, $numQuestions);

		// DEBUG
		echo "Preparing second query...";

		$sql = "select * from TriviaQuestions where questionPool = ? and questionNum = ?;";
		$stmt = sqlsrv_prepare( $conn, $sql, array( &$pool, &$selectedQuestion ) );
		sqlsrv_execute($stmt);
		
		// DEBUG
		echo "Fetching results...";
		
		$row = sqlsrv_fetch_array($stmt);
		$questionNum = $row["questionNum"];
		$question = $row["question"];
		$options =  array($row["option1"],
						  $row["option2"],
						  $row["option3"],
						  $row["option4"],
						  $row["option5"],
						  $row["option6"]);

		// DEBUG
		echo "Constructing output...";
		
		$output = "<h2>Question " . $questionNum . ":</h2>";
		$output .= "<p>" . $question . "</p>";
		$output .= "<ul>";
		$count = count($options);
		for ($i = 0; $i < $count; $i++) 
		{
			$output .= "<li><input type='radio' name='answer' value='";
			$output .= $i . "' />" . $options[$i] . "</li>";
		}
		$output .= "</ul>";
		echo "<script language='JavaScript'>";
		echo "document.getElementById('question').innerHTML = " . $output .";";
		echo "</script>";
		
		// DEBUG
		echo "Done!";
//	}
?>