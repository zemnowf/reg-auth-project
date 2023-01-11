<?php

namespace Repository;

use Model\User;
use Repository\UserIterator\StoredUsersIterator;

class JsonUserRepository implements UserRepository
{
    private static $instanse = null;
    private $storageFile = "Data/Data.json";
    private $storedUsers;
    private StoredUsersIterator $storedUsersIterator;

    private function __construct()
    {
        $this->storedUsers = json_decode(file_get_contents($this->storageFile), true);
        $this->storedUsersIterator = new StoredUsersIterator($this->storedUsers);
        $this->validateStorage($this->storageFile);
    }

    public static function getInstance(): JsonUserRepository
    {
        if (self::$instanse != null) {
            return self::$instanse;
        } else {
            return new static();
        }
    }

    public function insertUser($user): bool
    {
        $this->storedUsers[] = $user;
        if (file_put_contents($this->storageFile, json_encode($this->storedUsers, JSON_PRETTY_PRINT))) {
            return true;
        } else {
            return false;
        }
    }

    public function findIfUserExistsByName($username): bool
    {
        foreach ($this->storedUsersIterator as $user) {
            if ($username == $user->username) {
                return true;
            }
        }
        return false;
    }

    public function findIfUserExistsByEmail($email): bool
    {
        foreach ($this->storedUsersIterator as $user) {
            if ($email == $user->email) {
                return true;
            }
        }
        return false;
    }

    public function deleteUserByName($checkUser): bool
    {
        foreach ($this->storedUsers as $user) {
            if ($checkUser['username'] == $user['username']) {
                unset($this->storedUsers[$user['username']]);
                return true;
            }
        }
        return false;
    }

    public function updateUserByName($checkUser): bool
    {
        foreach ($this->storedUsers as $user) {
            if ($checkUser['username'] == $user['username']) {
                $result = array_replace($this->storedUsers[$user], $checkUser);
                $this->storedUsers[$user] = $result;
                return true;
            }
        }
        return false;
    }

    public function validateStorage($storage)
    {
        if (!file_exists($storage)) {
            $fp = fopen($storage, 'w');
            fwrite($fp, json_encode([]));
            fclose($fp);
            $user = new User("test", "test", "test", "test", "test");
            $this->insertUser($user);
        }
    }

    function getAll(): StoredUsersIterator
    {
        return $this->storedUsersIterator;
    }

}