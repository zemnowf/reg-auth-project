<?php

namespace Repository\UserIterator;

use Iterator;

class StoredUsersIterator implements Iterator
{

    private int $position = 0;

    private array $storedUsers = [];

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