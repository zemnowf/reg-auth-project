<?php

namespace Model\Builder;

use Model\ApiResponse;


class ApiResponseBuilder
{

    private ApiResponse $apiResponse;

    public function __construct()
    {
        $this->apiResponse = new ApiResponse();
    }

    public function build(): ApiResponse
    {
        return $this->apiResponse;
    }

    function body($body): ApiResponseBuilder
    {
        $this->apiResponse->setBody($body);
        return $this;
    }

    function success($success): ApiResponseBuilder
    {
        $this->apiResponse->setSuccess($success);
        return $this;
    }
}