<?php

function getPassword(string $prompt = "Enter Password:"): string
{
    echo $prompt;
    system('stty -echo');
    $password = trim(fgets(STDIN));
    system('stty echo');
    echo "\n";
    return $password;
}
