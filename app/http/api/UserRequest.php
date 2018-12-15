<?php
namespace App\Http\Api;
use Light\Request;

/**
 * This class will handles all params from http request of user object
 * + GET
 * + POST
 * + PUT
 * + Headers
 * 
 */
class UserRequest extends Request
{
    protected $email = '';
    protected $password = '';
    protected $name = '';

    function __construct()
    {
        parent::__construct();

        $this->setName();
        $this->setEmail();
        $this->setPassword();
    }

    /**
     * This function will valid all params of user object request
     * and before send these params into model to process business logic
     * 
     * @return boolean
     */
    public function isValid()
    {
        if ($this->isEmailValid() && $this->isPasswordValid()) {
            return true;
        }
        return false;
    }

    /**
     * This function will check email property of request object valid or invalid
     * 
     * @return boolean
     */
    public function isEmailValid()
    {
        if (!$this->email) return false;

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) return false;

        return true;
    }

    /**
     * This function will check password property of request object valid or invalid
     * 
     * @return boolean
     */
    public function isPasswordValid()
    {
        if (!$this->password) return false;

        return true;
    }

    /**
     * This function set value for email property user request object
     *
     * @return void
     */
    public function setEmail()
    {
        $post = $this->postParams();

        $this->email = @$post['email'];
    }

    /**
     * This function set value for password property user request object
     *
     * @return void
     */
    public function setPassword()
    {
        $post = $this->postParams();

        $this->password = @$post['password'];
    }

    /**
     * This function set value for name property user request object
     *
     * @return void
     */
    public function setName()
    {
        $post = $this->postParams();

        $this->name = @$post['name'];
    }

    /**
     * This function get value of email property of user request object
     *
     * @return void
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * This function get value of password property of user request object
     *
     * @return void
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * This function get value of name property of user request object
     *
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }
}