<?php

/*
* The following script searches pi for a thing called 'self locating strings': 
* a sequence of numbers that matches the position the string is located at.

* Example:
* Pi = 3.1415926535897932
* The first decimal after the point (1) happens to be at position 1: 
* it is a self-locating string.
*
* When we look at position 11, we see the digits "89" rather than "11".
* 11 is therefore not a self locating string.
*
* For a detailed explanation check out this youtube video:
* https://www.youtube.com/watch?v=W20aT14t8Pw
*
* This script goes through all integers up to the length of pi and verifies whether it is a self locating string.
* If so, the sequence of digits is presented on the page.
*
* To set up the script correctly, a text file containing digits of pi must be prepared.
* The decimal point (.) must be removed from the beginning of the file.
* If the file does not include the 3 that comes before the decimal point, the init counter on line #58 should
* be adjusted to 0 instead of 1.
*
*/

// Enter the correct filepath here
$pi = file_get_contents('pi_one_billion.txt');
$pi_length = strlen($pi) - 1;

// This function takes a number, and checks whether it matches with the offset of its occurrence.
function checkPosition($pi, $i){
	// Typecast the position($i) to (string)
	$i_string = (string) $i;
	// Determine the length of the string
	$i_length = strlen($i_string);	
	
	// Loop through the string
	for ($j = 0; $j < $i_length; $j++) { 
		// If the digits of the integer do not match the digits that make up the offset of its occurrence,
		if ($pi[$i + $j] != $i_string[$j]) {
			// Exit the function immediately
			return false;
		} 
	}
	return true;
}

// Declare a counter
$counter = 0;

// Start a stopwatch 
$start = microtime(true);


// Loop through all integers between 1 and $pi_length
for ($i = 1; $i < $pi_length; $i++) { 
	// Verify for each integer whether it is a self-locating string
	if (checkPosition($pi, $i)){
		// Increment the counter
		$counter++;
		// If there is a match, present the self locating string on the page
		echo $i.'<br>';
	}

}

// Stop the stopwatch
$finish = microtime(true);
// Calculate the difference
$time = $finish - $start;
// Present the answer
echo "<p>$counter self-locating strings found between 1 and $pi_length. Computed in: $time sec</p>";
