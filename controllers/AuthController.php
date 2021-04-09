<?php 

namespace app\controllers;

use app\{
    core\Controller,
    core\Request,
    models\RegisterModel
};

class AuthController extends Controller {

    public function login(Request $request) 
    {
        $this->setLayout('auth');
        if($request->isPost()) {
            var_dump($request->getBody());
            return 'Handle Login';
        }
        return $this->render('login');
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
            
            return $this->render('register',    ['model' => $registerModel]);
        } else return $this->render('register', ['model' => $registerModel]);
    }

}