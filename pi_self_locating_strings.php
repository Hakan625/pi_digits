<?php

/*
* The following script searches pi for a thing called 'self locating strings': 
* a sequence of numbers that matches the position the string is located at.

* Example:
* Pi = 3.1415926535897932
* If we look up "1" within the expansion of pi, we find that it's located at position 1: 
* We say that "1" is a self-locating string.
*
* When we look up the string "2", we find that its first occurrence is located at position 6, rather than 2.
* "2" is therefore not a self locating string.
*
* For a detailed explanation check out this youtube video:
* https://www.youtube.com/watch?v=W20aT14t8Pw
*
* This script goes through all integers up to the length of pi and verifies whether it is a self locating string.
* If so, the sequence of digits is presented on the page.
*
* To set up the script correctly, a text file containing digits of pi must be prepared.
* You may download a number of digits online and put them in the same folder as this php file.
*
*/

// Enter the correct filepath here
$pi = file_get_contents('pi_one_and_a_half_billion.txt');
$pi[0] = '.';
$pi_length = strlen($pi) - 2;

function checkPosition($pi, $i){
	// Typecast the position($i) to (string)
	$string = (string) $i;
	// Determine the length of the string
	$length = strlen($string);	
	
	// Loop through the string
	for ($j = 0; $j < $length; $j++) { 
		// If the digits of the integer do not match the digits that make up the offset of its occurrence,
		if ($pi[$i + $j + 1] != $string[$j]) {
			// Exit the function immediately
			return false;
		} 
	}
	// Here? The string matches its offset
	return true;
}

// Declare a counter
$counter = 0;

// Start a stopwatch 
$start = hrtime();

// Loop through all integers between 1 and $pi_length
for ($i = 1; $i < $pi_length; $i++) { 
	// Verify for each integer whether it is a self-locating string
	if (checkPosition($pi, $i)){
		// Increment the counter
		$counter++;
		// If there is a match, present the self locating string in the browser
		echo $i.'<br>';
	}

}

// Stop the stopwatch
$finish = hrtime();
// calculate the time differece
$time = ($finish[0] + ($finish[1] / 10**9)) - ($start[0] + ($start[1] / 10**9));
// Present the answer on the page
echo "<p>$counter self-locating strings found between 1 and $pi_length. Computed in: $time sec</p>";
