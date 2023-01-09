<?php

namespace Service;

use Model\ApiResponse;
use Repository\JsonUserRepository;
use Repository\UserRepository;
use Validation\UserValidator;

class DefaultUserService implements UserService
{
    private static $instance = null;
    private UserRepository $userRepository;
    private UserValidator $userValidator;

    private function __construct(UserRepository $userRepository, UserValidator $userValidator)
    {
        $this->userRepository = $userRepository;
        $this->userValidator = $userValidator;
    }

    public static function getInstance(): DefaultUserService
    {
        if (self::$instance != null) {
            return self::$instance;
        } else {
            return new static(JsonUserRepository::getInstance(), new UserValidator());
        }
    }

    function login($username, $password): ApiResponse
    {

        if (!$this->userValidator->validateEmptySignInField($username, $password)) {
            return ApiResponse::builder()
                ->body([
                    "status" => false,
                    "error" => "All fields are required"
                ])
                ->success(false)
                ->build();
        }

        foreach ($this->userRepository->getAll() as $user) {

            if ($username == $user->username) {
                $password = md5($password . "ffawc3");
                if ($password == $user->password) {
                    return ApiResponse::builder()
                        ->body([
                            "username" => $user->username,
                            "email" => $user->email,
                            "name" => $user->name
                        ])
                        ->success(true)
                        ->build();

                } else {
                    return ApiResponse::builder()
                        ->body([
                            "status" => false,
                            "error" => "Incorrect password"
                        ])
                        ->success(false)
                        ->build();
                }
            }
        }
        return ApiResponse::builder()
            ->body([
                "status" => false,
                "error" => "User is not signed in yet"
            ])
            ->success(false)
            ->build();
    }

    function registration($user): ApiResponse
    {
        $result = $this->userValidator->validateUser($user);

        if (!empty($result)) {
            return ApiResponse::builder()
                ->body($result)
                ->success(false)
                ->build();
        }

        if ($this->existsByName($user->getUsername())) {
            return ApiResponse::builder()
                ->body([
                    "status" => false,
                    "message" => "User with such username is already signed up, please choose another username",
                    "error_id" => ""
                ])
                ->success(false)
                ->build();
        }

        if ($this->existsByEmail($user->getEmail())) {
            return ApiResponse::builder()
                ->body([
                    "status" => false,
                    "message" => "User with such email is already signed up, please choose another username",
                    "error_id" => ""
                ])
                ->success(false)
                ->build();
        }

        $new_user = [
            "username" => $user->getUsername(),
            "password" => md5($user->getRawPassword() . "ffawc3"),
            "email" => $user->getEmail(),
            "name" => $user->getName()
        ];

        $response = $this->userRepository->insertUser($new_user);
        if ($response) {
            return ApiResponse::builder()
                ->body(["status" => true,
                    "success" => "Successfully signed up"])
                ->success(true)
                ->build();

        } else {
            return ApiResponse::builder()
                ->body(["status" => false,
                    "success" => "Something went wrong"])
                ->success(false)
                ->build();

        }
    }

    private function existsByName($name)
    {
        return $this->userRepository->findIfUserExistsByName($name);
    }

    private function existsByEmail($email)
    {
        return $this->userRepository->findIfUserExistsByEmail($email);
    }

}
