<?php
namespace App\Model;

use App\Library\ArrayHandler;

/**
 * Clone Appication\Model\Session class
 * 
 */
class SessionWeb
{
    protected $id;
    protected $loginId;
    protected $uuid;
    protected $role = 'user';
    protected $createdDate;
    protected $lastestLogin;

    function __construct($session)
    {
        if (!$session) return $this;

        $this->id = @$session['id'];
        $this->loginId = @$session['userId'];
        $this->uuid = @$session['uuid'];
        $this->role = @$session['role'];
        $this->createdDate = !@$session['created'] ?: date('Y-m-d h:m:s', $session['created']);
        $this->lastestLogin = !@$session['lastest'] ?: date('Y-m-d h:m:s', $session['lastest']);

        return $this;
    }

    public function get()
    {
        $arrayHandler = new ArrayHandler();
        return $this->objToArray($this, $arr);
    }
    

    public function objToArray($obj, &$arr){

        if(!is_object($obj) && !is_array($obj)){
            $arr = $obj;
            return $arr;
        }

        foreach ($obj as $key => $value)
        {
            if (!empty($value))
            {
                $arr[$key] = array();
                $this->objToArray($value, $arr[$key]);
            }
            else
            {
                $arr[$key] = $value;
            }
        }
        return $arr;
    }

}