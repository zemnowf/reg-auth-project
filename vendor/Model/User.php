<?php

namespace Model;

class User
{
    private $username;
    private $raw_password;
    private $sub_password;
    private $email;
    private $name;

    public function __construct($username, $raw_password, $sub_password, $email, $name)
    {
        $this->username = $username;
        $this->raw_password = $raw_password;
        $this->sub_password = $sub_password;
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
        return $this->raw_password;
    }

    /**
     * @param mixed $raw_password
     */
    public function setRawPassword($raw_password)
    {
        $this->raw_password = $raw_password;
    }

    /**
     * @return mixed
     */
    public function getSubPassword()
    {
        return $this->sub_password;
    }

    /**
     * @param mixed $sub_password
     */
    public function setSubPassword($sub_password)
    {
        $this->sub_password = $sub_password;
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
