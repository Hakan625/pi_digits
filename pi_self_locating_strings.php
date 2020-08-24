<?php

/*
* The following script searches pi for a thing called 'self locating strings': 
* a string of numbers that correspond with the position the string is located at.

* Example:
* Pi = 3.1415926535897932
* The first decimal after the point (1) happens to be at position 1: it is a self-
* locating string.
*
* When we look at position 11, we see the digits "89".
* 11 is therefore not a self locating string.
*
* For a detailed explanation check out this youtube video:
* https://www.youtube.com/watch?v=W20aT14t8Pw
*
* This script goes through all integers and checks whether it is a self locating string.
* If so, the sequence of digits is presented on the page.
*
* To set up the script correctly, a text file containing digits of pi must be prepared.
* Depending on your computer's memory capacity, a maximum number of digits should be set to load into the memory.
* The decimal point (.) must be removed from the beginning of the file.
* If the file does not include the 3 that comes before the decimal point, the init counter inside the for-loop should
* be adjusted to 0 instead of 1.
*
* Limitations concerning PHP's runtime and maximum memory allocation must also be lifted. 
*/

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
