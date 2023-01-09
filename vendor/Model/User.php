<?php

namespace Model;

class User
{
    private $username;
    private $rawPassword;
    private $subPassword;
    private $email;
    private $name;

    public function __construct($username, $rawPassword, $subPassword, $email, $name)
    {
        $this->username = $username;
        $this->rawPassword = $rawPassword;
        $this->subPassword = $subPassword;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getRawPassword()
    {
        return $this->rawPassword;
    }

    /**
     * @param mixed $rawPassword
     */
    public function setRawPassword($rawPassword)
    {
        $this->rawPassword = $rawPassword;
    }

    /**
     * @return mixed
     */
    public function getSubPassword()
    {
        return $this->subPassword;
    }

    /**
     * @param mixed $subPassword
     */
    public function setSubPassword($subPassword)
    {
        $this->subPassword = $subPassword;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}
