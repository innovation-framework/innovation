<?php
namespace App\Controller\Api;

use Light\Controller;
use App\Http\Api\UserRequest;
use App\Model\User as UserModel;
use App\Model\Session as SessionModel;
use App\Http\Middleware\Authentication;

/**
 * This controller will handler all requests to User object
 */
class User extends Controller
{
    public function __construct()
    {
        parent::__construct([]);
        $this->middleware = new Authentication();
    }

    /**
     * This funtion will handle list all users
     * search one or more users with paging
     * 
     * @return json/xml depends on response type
     */
    public function indexAction()
    {
        $request = new UserRequest();
        $app = $GLOBALS['app'];
        $app->bind('user', function ($value)
        {
            return new UserModel($request);
        });

        $user = $app->make('user');

        $users = $user->findBy($request->getParams());
        $totals = count($users);

        return $this->response->setContent([
            'data' => $totals > 1 ? $users : @$users[0], 'totals' => $totals, 'code' => 200, 'message' => $this->language->messages->success
        ]);
    }

    /**
     * This function will handle register user
     * and handle errors when user registers
     * 
     * @return json/xml depend on response type you want
     */
    public function signupAction()
    {
        $request = new UserRequest();

        if ($request->isValid()) {
            $user = new UserModel($request);

            if ($user->checkEmailExist()) {
                return $this->response->setContent([
                    'error' => ['message' => $this->language->errors->emailExist],
                    'code' => 200
                ]);
            }

            if ($newUser = $user->create()) {
                return $this->response->setContent([
                    'data' => $newUser, 'code' => 200, 'message' => $this->language->messages->signupSuccess
                ]);
            }
        }

        return $this->response->setContent([
            'error' => ['message' => $this->language->errors->emailPasswordInvalid],
            'code' => 200
        ]);
    }

    /**
     * This function will handle signin of user
     * and handle errors when user signin to app
     * 
     * @return json/xml depend on response type you want
     */
    public function signinAction()
    {
        $request = new UserRequest();

        if ($request->isValid()) {
            $user = new UserModel($request);

            if (!$user->checkEmailExist()) {
                return $this->response->setContent([
                    'error' => ['message' => $this->language->errors->emailNotExist],
                    'code' => 200
                ]);
            }

            if (!$userObj = $user->isValidEmailAndPassword()) {
                return $this->response->setContent([
                    'error' => ['message' => $this->language->errors->emailOrPasswordIncorrect],
                    'code' => 200
                ]);
            }

            // Create session and return json response
            // depend on device type = mobile/other devices
            $headers = $request->getHeaders();
            $type = @$headers['X-Device'];

            $session = new SessionModel($userObj);
            if ($newSession = $session->create($type)) {
                return $this->response->setContent([
                    'data' => $newSession, 'code' => 200, 'message' => $this->language->messages->loginSuccess
                ]);
            }
        }

        return $this->response->setContent([
            'error' => ['message' => $this->language->errors->emailPasswordInvalid],
            'code' => 200
        ]);
    }

    /**
     * This function will handle logout
     * 
     * @return json/xml depend on response type if you want
     */
    public function logoutAction()
    {
        $session = new SessionModel(null);
        if ($session->destroy()) {
            return $this->response->setContent([
                'data' => null, 'code' => 200, 'message' => $this->language->messages->logoutSuccess
            ]);
        }
        return $this->response->setContent([
            'error' => ['message' => $this->language->errors->notLogin],
            'code' => 200
        ]);
    }
}