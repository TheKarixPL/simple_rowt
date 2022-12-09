<?php

require_once '../config.php';

function openConnection(): PDO
{
    return new PDO(DB_CONNECTION_STRING, DB_LOGIN, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
