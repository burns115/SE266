<?php

//creates the function dd
function dd($data) {
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';
};