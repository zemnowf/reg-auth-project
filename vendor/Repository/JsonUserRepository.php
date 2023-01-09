<?php
//require_once('User.php');

namespace Repository;

use Model\User;

class JsonUserRepository implements UserRepository
{
    private static $instanse = null;
    private $storageFile = "Data/Data.json";
    private $storedUsers;

    private function __construct()
    {
        $this->storedUsers = json_decode(file_get_contents($this->storageFile), true);
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

    public function findIfUserExistsByName($username)
    {
        foreach ($this->storedUsers as $user) {
            if ($username == $user['username']) {
                return true;
            }
        }
        return false;
    }

    public function findIfUserExistsByEmail($email)
    {
        foreach ($this->storedUsers as $user) {
            if ($email == $user['email']) {
                return true;
            }
        }
        return false;
    }

    public function deleteUserByName($checkUser)
    {
        foreach ($this->storedUsers as $user) {
            if ($checkUser['username'] == $user['username']) {
                unset($this->storedUsers[$user['username']]);
            }
        }
        return false;
    }

    public function updateUserByName($checkUser)
    {
        foreach ($this->storedUsers as $user) {
            if ($checkUser['username'] == $user['username']) {
                array_replace($this->storedUsers[$user], $checkUser);
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

    function getAll()
    {
        return $this->storedUsers;
    }

}