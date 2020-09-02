<?php

/*
* This script looks for loops within pi's digits.
*
* check out this video https://www.youtube.com/watch?v=W20aT14t8Pw&t=390 for a detailed explanation of the idea.
* 
* Of each integer within a defined range, the position of its first occurrence is searched within pi. 
* That number is then fed back into the searching function to produce another position.
* With enough repetitions, observation tells us that some positions loop back around previous positions.
* How many repetitions are needed varies between numbers.
*
* This script offers knowledge about those positions and the number of repetitions required to complete the loop.
*
* Note: for this to work, the first character in the file containing the digits must be a non-numeric character (for example: a decimal point).
* The 3 preceding the decimal point must also be removed, because we are only interested in the digits after the decimal point
* and among humans, "position 0" isn't a popular way to denote the first position.
*
*/

function findLoop($pi, $string, $starting_number, $counter = 0, $positions = []){

	// Perform a search for the sequence of digits within pi, and capture the offset in $matches (array).
	preg_match('/'.$string.'/', $pi, $matches, PREG_OFFSET_CAPTURE);
	// If the sequence was found, the number of elements in the $matches array will be greater than 0.
	if (count($matches) > 0) {
		// Store the offset as $position
		$position = $matches[0][1];
	} else {
		/* 
		* If the number of elements is 0, no match was found within the available digits of pi.
		* That does not mean that the sequence is nowhere to be found within pi, only that you ran out of digits to search through.
		* This is a common phenomenon considering the steady growth of the number of digits with each iteration).
		* The more digits a sequence consists of, the more unlikely its occurrence within a limited number of digits.
		* Here lies the heart of the matter. Given enough digits, will a loop always occur? 
		* One way to find out is to expand the file with more digits.
		* For now, exit the function to continue and search with a different number
		*/
		return;
	}

	// Verify that the captured position is novel
	if (!in_array($position, $positions)) {
		// If so, select it as the next string to search for
		$string = $position;
		// Add the string to the $positions array
		$positions[] = $position;
		// Increment the counter.
		$counter++;
		// Re-enter the new string back into the function recursively
		findLoop($pi, $string, $starting_number, $counter, $positions);
	} else {
		// If the position is already present within the $positions array, it means that a loop has occurred.

		// Gather the information
		$content = "After $counter iterations, the number $starting_number loops back to a previous position.";
		// Display the information in the browser
		echo "<p>".$content."</p>";
		// Concatenate two line breaks
		$content .= PHP_EOL.PHP_EOL;
		// Add the starting number
		$content .= $starting_number.PHP_EOL;
		// Add the final (repeating) position to the $positions array, to demonstrate that the loop occurs.
		$positions[] = $position;

		// Loop through the $positions array and concatenate the content.
		foreach ($positions as $key => $position) {
			$content .= $position.PHP_EOL;
		}
		// Prepare a directory to store the data.
		if (!is_dir('loops')) {
			mkdir('loops');
		}

		// Save the data on the hard drive,
		file_put_contents("loops/starting_number_".$starting_number.".txt", $content);
		// And exit the function.
		return;
	}
}

// Load the digits of pi into memory (enter the correct filepath here)
$pi = file_get_contents('pi_one_billion.txt');

// Define boundaries within which to search
$lower_boundary = 6650;
$upper_boundary = 6670;

// Start a stopwatch
$start = hrtime();

// Start the search 
for ($i = $lower_boundary; $i < $upper_boundary; $i++) { 
	// Lift off!
	findLoop($pi, $i, $i);
}

// Stop the stopwatch	
$finish = hrtime();
// Calculate the difference
$time = ($finish[0] + ($finish[1] / 1000000000)) - ($start[0] + ($start[1] / 1000000000));
// Present the answer
echo "<p>Completed the search in: $time sec. Go ahead and look in the loops/ directory</p>";

?>
