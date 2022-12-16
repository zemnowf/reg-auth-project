<?php
require_once ('user.class.php');

class UserStorage {
    private $storage = "data/data.json";

    private $stored_users;

    public function __construct(){
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->validateStorage($this->storage);
    }

    public function insertUser($user){
        $new_user = [
            "username" => $user->getUsername(),
            "password" => md5($user->getRawPassword()."ffawc3"),
            "email" => $user->getEmail(),
            "name" => $user->getName()
        ];
        $this->stored_users[] = $new_user;
        if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
            $response = ["status"=>true,
                "success"=>"Successfully signed up"];
        } else {
            $response = ["status"=>false,
                "error"=>"Something went wrong"];
        }
        echo json_encode($response);
        exit();
    }

    public function login($username, $password){
        $validator = new Validator();

        if(!$validator->validateEmptySignInField($username, $password)){
            $response = [
                "status" => false,
                "error" => "All fields are required"
            ];
            echo json_encode($response);
            exit();
        }

        foreach ($this->stored_users as $user){

            if($username == $user['username']){
                $password = md5($password."ffawc3");
                if($password == $user['password']){
                    $_SESSION['user'] = [
                        "username" => $user['username'],
                        "email" => $user['email'],
                        "name" => $user['name']
                    ];
                    $response = ["status"=>true];
                    echo json_encode($response);
                    exit();
                } else {
                    $response = [
                        "status" => false,
                        "error" => "Incorrect password"
                    ];
                    echo json_encode($response);
                    exit();
                }
            }
        }
        $response = [
            "status" => false,
            "error" => "User is not signed in yet"
        ];
        echo json_encode($response);
        exit();
    }

    public function findIfUserExistsByName($username){
        foreach ($this->stored_users as $user){
            if($username == $user['username']){
                return true;
            }
        }
        return false;
    }

    public function findIfUserExistByEmail($email){
        foreach ($this->stored_users as $user){
            if($email == $user['email']){
                return true;
            }
        }
        return false;
    }

    public function deleteUserByName($checkUser){
        foreach ($this->stored_users as $user){
            if($checkUser['username'] == $user['username']){
                unset($this->stored_users[$user['username']]);
            }
        }
        return false;
    }

    public function updateUserByName($checkUser){
        foreach ($this->stored_users as $user){
            if($checkUser['username'] == $user['username']){
                array_replace($this->stored_users[$user], $checkUser);
            }
        }
        return false;
    }

    public function validateStorage($storage){
        if(!file_exists($storage)){
            $fp = fopen($storage, 'w');
            fwrite($fp, json_encode([]));
            fclose($fp);
            $user = new User("test", "test", "test", "test", "test");
            $this->insertUser($user);
        }
    }

}