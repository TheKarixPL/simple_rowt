<?php

require_once "../common/db.php";
require_once "../common/util.php";
require_once "response.php";

session_start();

try
{
    switch ($_SERVER["REQUEST_METHOD"])
    {
        case "GET":
            API\BooleanResponse::sendBoolean(!empty($_SESSION["session_admin_id"]));
            break;
        case "POST":
            $request = json_decode(file_get_contents("php://input"));
            $login = $request->login;
            $password = $request->password;
            if(empty($login))
            {
                API\ErrorResponse::sendError("login is empty");
                die();
            }
            else if(empty($password))
            {
                API\ErrorResponse::sendError("password is empty");
                die();
            }

            $db = openConnection();
            $stmt = $db->prepare("select id, password from admin where login = ?;");
            $stmt->execute([$login]);
            if($stmt->columnCount() === 0)
            {
                API\ErrorResponse::sendError("user \"$login\" does not exist");
                die();
            }
            $row = $stmt->fetchAll()[0];
            $id = (int)$row["id"];
            $hashedPassword = $row["password"];
            if(password_verify($password, $hashedPassword))
            {
               session_destroy();
               $_SESSION["session_admin_id"] = $id;
               $stmt = $db->prepare("insert into admin_history(admin_id, time, ip) values (?, NOW(), ?);");
               $stmt->execute([$id, $_SERVER['REMOTE_ADDR']]);
            }
            else
            {
                API\ErrorResponse::sendError("wrong password");
                die();
            }
            break;
        case "DELETE":
            session_destroy();
            break;
        default:
            API\ErrorResponse::sendError("Wrong method");
            break;
    }
}
catch(Exception $e)
{
    error_log($e);
    API\ErrorResponse::sendError("Error");
    die();
}
