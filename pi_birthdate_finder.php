<?php

/*
* This script searches for sequences of numbers within pi and offers knowledge about its position.
* 
* You must prepare a text file containing digits of pi and enter its filepath below.
* The page will ask for an input and the script will search within the supplied file.
*
*
*/


	// A function which verifies whether a supplied string is found in another string
	function checkSequence($pi, $i, $string, $string_length){
		for ($j = 0; $j < $string_length; $j++) { 
			if ($pi[$i + $j] != $string[$j]) {
				return false;
			} 
		}
		return true;
	}

	if (!empty($_POST['date'])) {
		// Load the digits of pi into memory (enter the correct filepath here)
		$pi = file_get_contents('pi_one_billion.txt');

		// Determine the number of digits in the file
		$pi_length = strlen($pi);

		// Retrieve the entered string
		$string = $_POST['date'];

		// Determine the length of the string
		$string_length = strlen($string);	

		// Start a stopwatch
		$start = microtime(true);
		// Declare a counter
		$counter = 0;

		// Search through all available digits of pi, minus the length of the entered string
		for ($i = 0; $i < $pi_length - $string_length; $i++) {
			if (checkSequence($pi, $i, $string, $string_length)){
				// If the entered string is found, present it along with the position at which it was found
				echo "\"$string\" found at position: $i<br>";
				// Count the number of matches
				$counter += 1;
			}
		}

		// Stop the stopwatch
		$finish = microtime(true);
		// Calculate the difference
		$time = $finish - $start;
		// Present the answer
		echo "$counter instances found. Computed in: $time sec<br>";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pi Birthday finder</title>
</head>
<body>
	<p>The theory goes that every possible sequence of digits is found within the number Pi. But where exactly? Enter your date of birth and find out.</p>
	<form action="pi_birthdate_finder.php" method="POST">
		<input name="date">
		<button type="submit">Search!</button>
	</form>

</body>
</html>
