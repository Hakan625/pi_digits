<?php

/*
* Hello and welcome to Pi Loops
*
* check out this video https://www.youtube.com/watch?v=W20aT14t8Pw&t=390 for a detailed explanation of the idea.
* 
* The way it works is like this: 
* Take a number, and look up the first occurrence in the expansion of pi.
* Look at the offset of where it was found, and look up the first occurrence of that number
* Keep repeating this until you find that it returns to one of the previous offsets, effectively creating a loop.
*
*
* This script goes through all integers within a self defined range (lines 96 and 97) and collects
* the data on loops that were found, along with a seperate file containing positions that were not found.
* If you decide to start another search and you want to load those rejects back into memory,
* uncomment lines 103 and 104 by removing the two forward slashes at the start of the lines
*
* Preparation:
* Download a txt file with a number of pi digits (I downloaded 1.5 billion digits).
* Put the file in the same directory as this script.
* Open the file and inspect it: does it start with 3.1415... ?
* If so, no further action is needed. 
*
*/

function findLoop($pi,  $string,  $positions = [], $rejects = [], $counter = 0){

	// Check to see if string is one that is known to lead to a halted search
	if (in_array($string, $rejects)) {
		// Next, determine whether the number of positions up until now is greater than 1
		if (count($positions) > 1) {
			// Only then, add all positions (but the last one) to the rejects array
			$rejects = array_merge(array_slice($positions, 0, -1), $rejects);
		}
		return $rejects;
	}

	// search for the string in pi, and capture the offset
	preg_match('/'.$string.'/', $pi, $matches, PREG_OFFSET_CAPTURE);

	// If the string is not found
	if (count($matches) == 0) {
		// Add all positions to the array of rejects
		$rejects = array_merge($positions, $rejects);
		// return the rejects array and exit the function
		return $rejects;
	}

	// Here? The string was found! Let's continue.

	// select the offset as new string
	$position = (string) ($matches[0][1] - 1);


	// Determine whether the found position is novel
	if (!in_array($position, $positions)) {
		// Add the position to the positions array
		$positions[] = $position;
		// increment the iteration counter
		$counter++;
		// Re-enter the new position as the next string to recursively search for and return the rejects array that results from it
		return findLoop($pi, $position, $positions, $rejects, $counter);
		
	// If it is already present in the positions array, it means a loop has occurred!
	} else {
		// Collect the information
		$content = "After $counter iterations, the number $positions[0] loops back to a previous position.";
		// Display it in the browser
		echo "<p>".$content."</p>";
		// Concatenate two line-breaks
		$content .= PHP_EOL.PHP_EOL;

		// Append the final (repeating) position to demonstrate that the loop occurs
		$positions[] = $position;
		// Stack the positions one on top of the other
		$content .= implode(PHP_EOL, $positions);

		// Save the results to the hard drive
		file_put_contents("pi_loops/starting_number_".$positions[0].".txt", $content);
		return $rejects;
	}

}
//--------------------------------------------------------------------------------------------


// START HERE

// Load $pi into memory
$pi = file_get_contents('pi_one_and_a_half_billion.txt');
// change the 3 in an arbitrary non-numeric character, we don't want it included in the search
$pi[0] = ".";

// Define boundaries to search within
$lower_boundary = 1;
$upper_boundary = 100; // adjust this number to however deep you'd like your search to be

// start with an empty rejects array
$rejects = [];

// Or load the rejects from a previous search
// $rejects = file_get_contents('pi_loops/rejects/rejects.txt');
// $rejects = explode(PHP_EOL, $rejects);

// prepare a directory to store the data
if (!is_dir('pi_loops')) {
	mkdir('pi_loops');

}
// start a stopwatch
$start = hrtime();

// Start the program
for ($i = $lower_boundary; $i <= $upper_boundary; $i++) { 
	$positions = [$i];
	$rejects = findLoop($pi, $i, $positions, $rejects);
}

// Stop the stopwatch
$finish = hrtime();
$time = ($finish[0] + ($finish[1] / 10**9)) - ($start[0] + ($start[1] / 10**9));

// Save the rejects in a text file
$rejects = implode(PHP_EOL, $rejects);
if (!is_dir('pi_loops/rejects')) {
	mkdir('pi_loops/rejects');
}
file_put_contents('pi_loops/rejects/rejects.txt', $rejects);

// Finishing it off 
echo "<p>Completed the search in: $time sec.</p>";

?>
