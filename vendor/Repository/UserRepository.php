<?php

namespace Repository;

interface UserRepository
{
    function insertUser($user): bool;

    function findIfUserExistsByName($username);

    function findIfUserExistsByEmail($email);

    function deleteUserByName($checkUser);

    function updateUserByName($checkUser);

    function getAll();
}