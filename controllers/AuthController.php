<?php 

namespace app\controllers;

use app\{
    core\Controller,
    core\Request,
    models\RegisterModel,
    models\LoginModel
};

class AuthController extends Controller {

    public string $baseColor    = 'teal';

    public function login(Request $request) 
    {
        $this->setLayout('auth');
        $loginModel = new loginModel();
        if($request->isPost()) {
            $loginModel->loadData($request->getBody());
            if($loginModel->validate() && $loginModel->login()) {
                var_dump(['success' => $loginModel]);
            }

        }
        return $this->render('login', ['model' => $loginModel]);
    }

    public function register(Request $request) 
    {
        $this->setLayout('auth');
        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if($registerModel->validate() && $registerModel->register()) {
                var_dump(['success' => $registerModel]);
            }
            
        } return $this->render('register', ['model' => $registerModel]);
    }

}