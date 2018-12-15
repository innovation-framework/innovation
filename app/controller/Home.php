<?php
namespace App\Controller;

use Light\Controller;
use App\Http\Middleware\Home as HomeMiddleware;
use Light\Facade\Facades\Log;

/**
 * This class will hanle all request for UI
 */
class Home extends Controller
{
    public function __construct()
    {
        parent::__construct([]);
        $this->middleware = new HomeMiddleware();
    }

    public function indexAction($value='')
    {
        Log::writeWarning('log warning');
        Log::writeError('log errors');

        echo 'This is home page';
    }
}