<?php

//creates the function dd
function dd($data) {
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';
}

/* Return Fizz Buzz if multiple of 2 and 3 (6)
   Return Fizz if multiple of 2
   Return Buzz if multiple of 3
   Return $num otherwise
*/
$num = [];

function fizzBuzz($num) {
    for ($i = 1; $i <= 100; $i++) {

        if ($i % 6 == 0) {
            echo 'FizzBuzz<br>';

        } elseif ($i % 2 == 0) {
            echo 'Fizz<br>';

        } elseif ($i % 3 == 0) {
            echo 'Buzz<br>';

        } else {
            echo $i . '<br>';
        }
    }
}