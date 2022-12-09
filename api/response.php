<?php

namespace API
{
    class Error
    {
        public readonly string $description;

        /**
         * @param string $description
         */
        public function __construct(string $description = "")
        {
            $this->description = $description;
        }
    }

    abstract class Response
    {
        public function send(): void
        {
            header("Content-type: application/json");
            http_response_code(200);
            echo json_encode($this);
        }
    }

    class ErrorResponse extends Response
    {
        public Error $error;

        /**
         * @param Error $error
         */
        public function __construct(Error $error)
        {
            $this->error = $error;
        }

        public function send(): void
        {
            header("Content-type: application/json");
            http_response_code(500);
            echo json_encode($this);
        }

        public static function sendError(string $descriptions = ""): void
        {
            (new ErrorResponse(new Error($descriptions)))->send();
        }
    }

    class BooleanResponse extends Response
    {
        public readonly bool $value;

        /**
         * @param bool $value
         */
        public function __construct(bool $value)
        {
            $this->value = $value;
        }

        public function send(): void
        {
            header("Content-type: application/json");
            http_response_code(500);
            echo json_encode($this->value);
        }

        public static function sendBoolean(bool $value): void
        {
            (new BooleanResponse($value))->send();
        }
    }
}
