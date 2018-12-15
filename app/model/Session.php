<?php
namespace App\Model;

use Light\Model;
use Light\UUID;
use Light\Session as SessionLibrary;
use App\Model\SessionWeb;

/**
 * This class will implement business logic and it will map with session table/file
 * 
 */
class Session extends Model
{
    protected $id;
    protected $userId;
    protected $uuid;
    protected $role = 'user';
    protected $created;
    protected $lastest;

    protected $activeAttr = ['userId', 'uuid', 'role'];

    // Customize created & updated if you don't want to use default field created & updated
    protected $updatedColumn = 'lastest';

    function __construct($user)
    {
        parent::__construct();
        if ($user instanceof \stdClass) {
            if ($user->id) $this->setUserId($user->id);
            if ($user->role) $this->setRole($user->role);
            $this->setUuid(UUID::v4());
        }
    }


    public function setUserId($userId = '')
    {
        $this->userId = $userId;
    }

    public function setUuid($uuid = '')
    {
        $this->uuid = $uuid;
    }

    public function setRole($role='user')
    {
        $this->role = $role;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getActiveAttr()
    {
        return $this->activeAttr;
    }

    public function create($type = 'mobile')
    {
        $session = new SessionLibrary();
        if (!$session->get('user')) {
            $sessionObj = $this->connection->insert($this);
            $session->setSession('user', $sessionObj);
        }

        $sessionWeb = new SessionWeb($session->get('user'));

        return $type == 'mobile' ? $session->get('user') : $sessionWeb->get();
    }

    public function destroy()
    {
        $session = new SessionLibrary();
        if ($session->get('user')) {
            $session->clearAll();
            return true;
        }

        return false;
    }
}