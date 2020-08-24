# pi_digits
A fun little project dealing with the digits of pi.

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
