<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

restrictAccess();


use Helpers\Uri;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Helpers\Arr;

class Auth extends Base
{

    public function __construct(array $requestParams)
    {
        parent::__construct($requestParams);
    }

    public function getLogin()
    {
        Sentinel::logout();

        $this->layout = View::make('back/login');
    }

    public function getLogout()
    {
        Sentinel::logout();

        Uri::to('login');
    }

    public function anyLogin()
    {
        $this->layout = null;

        Sentinel::logout();

        $data = Arr::extract($this->getPostData(), ['email', 'password']);

        $result['status'] = 'nok';

        // Authenticate the user
        Sentinel::authenticate($data, false);

        if(Sentinel::check())
        {
            $result['redirectUrl'] = Uri::makeUriFromId('Admin');
            $result['status'] = 'ok';
        }

        echo json_encode($result);
    }
}