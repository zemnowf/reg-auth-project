<?php

namespace Repository\UserIterator;

use Iterator;
use Repository\UserIterator\User;

class StoredUsersIterator implements Iterator
{

    private $position = 0;

    private $storedUsers = [];

    public function __construct(array $storedUsers)
    {
        foreach ($storedUsers as $user) {
            $this->storedUsers[] = new User($user["username"],
                $user["password"], $user["email"], $user["name"]);
        }
    }


    public function current()
    {
        return $this->storedUsers[$this->position];
    }

    public function next()
    {
        ++$this->position;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->storedUsers[$this->position]);
    }

    public function rewind()
    {
        return $this->position = 0;
    }
}