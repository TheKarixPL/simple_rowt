<?php

require_once "../common/db.php";
require_once "../common/util.php";
require_once "response.php";

session_start();

try
{
    if(empty($_SESSION["session_admin_id"]))
    {
        API\ErrorResponse::sendError("Session does not exists");
        die();
    }
    switch ($_SERVER["REQUEST_METHOD"])
    {
        case "POST":
            $request = json_decode(file_get_contents("php://input"));

            if(empty($request->id))
            {
                API\ErrorResponse::sendError("id is empty");
                die();
            }
            else if(empty($request->pin))
            {
                API\ErrorResponse::sendError("pin is empty");
                die();
            }

            $id = (int)$request->id;
            $pin = (int)$request->pin;

            $db = openConnection();

        default:
            API\ErrorResponse::sendError("Wrong method");
    }
}
catch(Exception $e)
{
    error_log($e);
    API\ErrorResponse::sendError("Error");
    die();
}
