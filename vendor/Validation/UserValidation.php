<?php

namespace Validation;

use Storage\UserStorage;

class UserValidation
{

    private function validateEmptyFields($username, $raw_password, $sub_password, $email, $name)
    {
        if (empty($username) || empty($raw_password) || empty($sub_password) || empty($email) || empty($name)) {
            return false;
        }
        return true;
    }

    public function validateEmptySignInField($username, $password)
    {
        if (empty($username) || empty($password)) {
            return false;
        } else return true;
    }

    private function checkConfirmPassword($raw_password, $confirm_password)
    {
        if ($raw_password != $confirm_password) {
            return false;
        }
        return true;
    }

    private function validatePassword($raw_password)
    {
        $symbols = preg_match('@^[a-zA-Z0-9]*$@', $raw_password);
        $letters = preg_match('@[a-zA-Z]@', $raw_password);
        $numbers = preg_match('@[0-9]@', $raw_password);
        if (strrpos($raw_password, ' ') !== false) {
            return false;
        }
        if (!$letters || !$symbols || !$numbers || strlen($raw_password) < 6) {
            return false;
        }
        return true;
    }

    private function validateUsername($username)
    {
        if (strlen($username) < 6) {
            return false;
        }
        if (strrpos($username, ' ') !== false) {
            return false;
        }
        return true;
    }

    private function validateEmail($email)
    {
        if (strrpos($email, ' ') !== false) {
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    private function validateName($name)
    {
        if (strrpos($name, ' ') !== false) {
            return false;
        }
        if (!preg_match('@^[a-zA-Z]+$@', $name) || strlen($name) < 2) {
            return false;
        }
        return true;
    }

    public function validateUser($user)
    {

        $userStorage = new UserStorage();

        if (!$this->validateEmptyFields($user->getUsername(), $user->getRawPassword(), $user->getSubPassword(),
            $user->getEmail(), $user->getName())) {
            $response = [
                "status" => false,
                "message" => "All fields are required",
                "error_id" => ""
            ];
            echo json_encode($response);
            return false;
        }

        if (!$this->validateUsername($user->getUsername())) {
            $response = [
                "status" => false,
                "message" => "Username must be a minimum of 6 characters and have no spaces",
                "error_id" => "_username"
            ];
            echo json_encode($response);
            return false;
        }

        if (!$this->checkConfirmPassword($user->getRawPassword(), $user->getSubPassword())) {
            $response = [
                "status" => false,
                "message" => "Please, check password confirmation",
                "error_id" => "_confirm"
            ];
            echo json_encode($response);
            return false;
        }

        if (!$this->validatePassword($user->getRawPassword())) {
            $response = [
                "status" => false,
                "message" => "Password must contain letters and numbers only and be a minimum of 6 characters and
                have no spaces",
                "error_id" => "_password"
            ];
            echo json_encode($response);
            return false;
        }

        if (!$this->validateEmail($user->getEmail())) {
            $response = [
                "status" => false,
                "message" => "Invalid email format",
                "error_id" => "_email"
            ];
            echo json_encode($response);
            return false;
        }

        if (!$this->validateName($user->getName())) {
            $response = [
                "status" => false,
                "message" => "Name must contain letters only and be a minimum of 2 characters",
                "error_id" => "_name"
            ];
            echo json_encode($response);
            return false;
        }

        if ($userStorage->findIfUserExistsByName($user->getUsername())) {
            $response = [
                "status" => false,
                "message" => "User with such username is already signed up, please choose another username",
                "error_id" => ""
            ];
            echo json_encode($response);
            return false;
        }

        if ($userStorage->findIfUserExistByEmail($user->getEmail())) {
            $response = [
                "status" => false,
                "message" => "User with such email is already signed up, please choose another email",
                "error_id" => ""
            ];
            echo json_encode($response);
            return false;
        }

        return true;
    }

}
