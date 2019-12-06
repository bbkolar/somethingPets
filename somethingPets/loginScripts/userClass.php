
<?php

 /**
  * User class used in somethingPets. Stores a users username and password.
  */
class User implements JsonSerializable{
    private $username;
    private $password;

    // Constructor for user
    function __construct($username, $password)
    {
        $this->username = $username; // The username
        $this->password = $password; // The password
    }

    // JSON serailizes the users properties
    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}