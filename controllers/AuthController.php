<?php 

namespace app\controllers;

use app\{
    core\Application,
    core\Controller,
    core\Request,
    models\RegisterModel,
    models\LoginModel,
    utils\Util
};

class AuthController extends Controller {

    public string $baseColor    = 'teal';

    public function login(Request $request) 
    {
        $this->setLayout('auth');
        $loginModel = new loginModel(Application::$app->database::$mysqli);
        if($request->isPost()) {
            $loginModel->loadData($request->getBody());
            if($loginModel->login()) {
            }

        }
        return $this->render('login', ['model' => $loginModel]);
    }

    public function register(Request $request) 
    {
        $this->setLayout('auth');
        $registerModel = new RegisterModel(Application::$app->database::$mysqli);
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if($registerModel->register()) {
            } else {
            }
            
        } return $this->render('register', ['model' => $registerModel]);
    }

}