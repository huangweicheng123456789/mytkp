<?php
namespace entity;
class User{
    public $username;
    public $userpass;
    
    public function getUsername()
    {
        return $this->username;
    }

    
    public function getUserpass()
    {
        return $this->userpass;
    }

    
    public function setUsername($username)
    {
        $this->username = $username;
    }

   
    public function setUserpass($userpass)
    {
        $this->userpass = $userpass;
    }
    
}

?>