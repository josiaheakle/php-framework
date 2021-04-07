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
        $registerModal = new RegisterModel();
        if ($request->isPost()) {
            $registerModal->loadData($request->getBody());
            if($registerModal->validate() && $registerModal->register()) {
                var_dump(['success' => $registerModal]);
            }
            
            return 'Handle registration.';
        } else return $this->render('register', [
            'modal'=> $registerModal
        ]);
    }

}