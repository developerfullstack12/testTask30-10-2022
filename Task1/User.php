<!-- TASK 1 -->

<?php

class User
{
    private $setFirstName;
    private $setLastName;
    private $setEmail;

    public function __construct(){

    }
    /**
     * Set the firstname of the user.
     */
    function setFirstName($setFirstName) {
        $this->setFirstName = $setFirstName;
        return $this;
    }
    /**
     * Set the lastname of user.
     */
    function setLastName($setLastName) {
        $this->setLastName = $setLastName;
        return $this;
    }
    /**
     * Set the Email of user. 
     */
    function setEmail($setEmail) {
        $this->setEmail = " < ".$setEmail." >";
        return $this;
    }

    /**
     * This method used for converting class values into common string.
     */
    public function __toString()
    {
        return $this->setFirstName.' '.$this->setLastName.' '.$this->setEmail;
    }
}

/**
 * Object of the class
 */
$user = new User();

/**
 * Chaining method calling
 */
$user->setFirstName('John')
->setLastName('Doe')
->setEmail('john.doe@example.com');

/**
 * Output
 */
echo $user;
?>