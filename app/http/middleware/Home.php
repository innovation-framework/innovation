<?php
namespace App\Http\Middleware;
use Light\Middleware\Middleware;

/**
 * This class will help you re-filter requests before call to controller
 */
class Home extends Middleware
{
    /**
     * $ignore property will tell Application, we alway permit user 
     * can go to these actions without don't have any conditions
     * Example: all users can go to signin & signup url 
     * 
     * @var arrray
     */
    protected $ignore = ['index'];

    /**
     * $role property is used to set permisions for user
     * Example: 
     * + With user role only go to logout url
     * + With admin role can go to all url
     * 
     * @var array
     */
    protected $role = ['user' => ['logout'], 'admin' => ['*']];
}