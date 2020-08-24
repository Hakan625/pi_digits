<?php

// Enter the correct filepath here
$pi = file_get_contents('pi_one_billion.txt');
$pi_length = strlen($pi);

// This function takes an offset ($i), and checks whether the numeric representation ($i_string) of that offset matches the offset.
function checkPosition($pi, $i, $i_string, $i_length){
	for ($j = 0; $j < $i_length; $j++) { 
		if ($pi[$i + $j] != $i_string[$j]) {
			return false;
		} 
	}
	return true;
}

// Start a stopwatch 
$start = microtime(true);


// Loop through all integers up to the number of digits contained within the file.
for ($i = 1; $i < $pi_length; $i++) { 
	// Typecast the position($i) to a string
	$i_string = (string) $i; 	
	// Determine the length of the string
	$i_length = strlen($i_string);	
	// Feed the function the appropriate data and let it perform the check
	if (checkPosition($pi, $i, $i_string, $i_length)){
		// If there is a match, present the self locating string
		echo $i.'<br>';
	}

}

// Stop the stopwatch
$finish = microtime(true);
// Calculate the difference
$time = $finish - $start;
// Present the answer
echo "Computed in: $time sec<br>";
