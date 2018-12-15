<?php
namespace App\Model;

use Light\Model;
use App\Http\Api\UserRequest;
use Light\ArrayHandler;

/**
 * This class will implement business logic and it will map with user table/file
 * 
 */
class User extends Model
{
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $role = 'user';
    protected $created;
    protected $updated;

    // This property will permit save field into db
    protected $activeAttr = ['name', 'email', 'password', 'role'];

    function __construct($request)
    {
        parent::__construct();
        if ($request instanceof UserRequest) {
            if ($request->getEmail()) $this->setEmail($request->getEmail());
            if ($request->getPassword()) $this->setPassword($request->getPassword());
            if ($request->getName()) $this->setName($request->getName());
        }
    }


    public function findBy($conditions = [])
    {
        if (!$conditions) return [];

        $page = @$conditions['page'];
        $array = new ArrayHandler($conditions);
        $searchAble = ['email', 'name', 'lastestlogin'];

        $conditions = $array->getArrayByKeys($searchAble);
        $results = $this->connection->findBy($conditions);
        if ($page) return $results->paging($page);

        return $results->getResults();
    }

    public function checkEmailExist()
    {
        if ($this->connection->findOneBy(['email' => $this->email])) return true;

        return false;
    }

    public function isValidEmailAndPassword()
    {
        if ($user = $this->connection->findOneBy(['email' => $this->email, 'password' => $this->password])) return $user;

        return false;
    }

    public function setEmail($email = '')
    {
        $this->email = $email;
    }

    public function setPassword($password = '')
    {
        $this->password = $password;
    }

    public function setName($name = '')
    {
        $this->name = $name;
    }

    public function setRole($role='user')
    {
        $this->role = $role;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function create()
    {
        return $this->connection->insert($this);
    }

    public function getActiveAttr()
    {
        return $this->activeAttr;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->created;
    }
}