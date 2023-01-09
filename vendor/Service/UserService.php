<?php

namespace Service;

use Model\ApiResponse;

interface UserService
{

    function login($username, $password): ApiResponse;

    function registration($user): ApiResponse;

}