<?php

namespace Validation;

class UserValidator
{

    public function validateUser($user): array
    {
        if (!$this->validateEmptyFields(
            $user->getUsername(),
            $user->getRawPassword(),
            $user->getSubPassword(),
            $user->getEmail(),
            $user->getName())
        ) {
            return [
                "status" => false,
                "message" => "All fields are required",
                "error_id" => ""
            ];
        }

        if (!$this->validateUsername($user->getUsername())) {
            return [
                "status" => false,
                "message" => "Username must be a minimum of 6 characters and have no spaces",
                "error_id" => "_username"
            ];
        }

        if (!$this->checkConfirmPassword($user->getRawPassword(), $user->getSubPassword())) {
            return [
                "status" => false,
                "message" => "Please, check password confirmation",
                "error_id" => "_confirm"
            ];
        }

        if (!$this->validatePassword($user->getRawPassword())) {
            return [
                "status" => false,
                "message" => "Password must contain letters and numbers only and be a minimum of 6 characters and
                have no spaces",
                "error_id" => "_password"
            ];
        }

        if (!$this->validateEmail($user->getEmail())) {
            return [
                "status" => false,
                "message" => "Invalid email format",
                "error_id" => "_email"
            ];
        }

        if (!$this->validateName($user->getName())) {
            return [
                "status" => false,
                "message" => "Name must contain letters only and be a minimum of 2 characters",
                "error_id" => "_name"
            ];
        }

        return [];
    }

    private function validateEmptyFields($username, $raw_password, $sub_password, $email, $name): bool
    {
        if (empty($username) || empty($raw_password) || empty($sub_password) || empty($email) || empty($name)) {
            return false;
        }
        return true;
    }

    public function validateEmptySignInField($username, $password): bool
    {
        if (empty($username) || empty($password)) {
            return false;
        } else {
            return true;
        }
    }

    private function checkConfirmPassword($raw_password, $confirm_password): bool
    {
        if ($raw_password != $confirm_password) {
            return false;
        }
        return true;
    }

    private function validatePassword($raw_password): bool
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

    private function validateUsername($username): bool
    {
        if (strlen($username) < 6) {
            return false;
        }
        if (strrpos($username, ' ') !== false) {
            return false;
        }
        return true;
    }

    private function validateEmail($email): bool
    {
        if (strrpos($email, ' ') !== false) {
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    private function validateName($name): bool
    {
        if (strrpos($name, ' ') !== false) {
            return false;
        }
        if (!preg_match('@^[a-zA-Z]+$@', $name) || strlen($name) < 2) {
            return false;
        }
        return true;
    }
}
