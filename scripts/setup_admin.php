<?php

require_once '../common/db.php';
require_once "../common/util.php";

if(php_sapi_name() === "cli")
{
    $login = readline("login: ");
    $password = getPassword("password: ");

    //Validation
    if(empty($login))
        die("login is empty");
    else if(empty($password))
        die("password is empty");

    $db = openConnection();

    $stmt = $db->prepare("select count(*) = 0 from admin where login = ?;");
    $stmt->execute([$login]);
    if($stmt->fetchAll()[0][0])
    {
        $password = password_hash($password, CRYPT_BLOWFISH);
        $stmt = $db->prepare("insert into admin(login, password) values (?, ?);");
        $stmt->execute([$login, $password]);
    }
    else
    {
        die("user \"$login\" already exists");
    }
}
else
{
    die("This script only works in cli mode!");
}
