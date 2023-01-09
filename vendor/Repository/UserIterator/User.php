<?php

namespace Repository\UserIterator;

class User{
    public string $username;
    public string $password;
    public string $email;
    public string $name;

    public function __construct(string $username, string $password, string $email, string $name)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
    }


}