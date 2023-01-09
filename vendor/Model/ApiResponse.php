<?php

namespace Model;

use Model\Builder\ApiResponseBuilder;

class ApiResponse
{

    private $body;
    private $success;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param mixed $success
     */
    public function setSuccess($success): void
    {
        $this->success = $success;
    }

    public static function builder(): ApiResponseBuilder
    {
        return new ApiResponseBuilder();
    }

}
