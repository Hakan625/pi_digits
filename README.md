# pi_digits
A fun little project dealing with the digits of pi.

To set up the scripts correctly, a text file containing digits of pi must be prepared.
The files each contain instructions on how to properly set up that file.
Depending on your computer's memory capacity, a limited number of digits can be loaded into the memory.

PHP has built-in limitations on runtime and maximum memory allocation.
For these scripts to run to completion, or to load billions of digits in the first place,
these limitations must be lifted. Locate the php.ini file where PHP was installed and adjust the values for
"memory_limit" and "max_execution_time" to -1 and 0 respectively.


// php.ini
; Maximum amount of memory a script may consume
; http://php.net/memory-limit
memory_limit=-1


; Maximum execution time of each script, in seconds
; http://php.net/max-execution-time
; Note: This directive is hardcoded to 0 for the CLI SAPI
max_execution_time=0
