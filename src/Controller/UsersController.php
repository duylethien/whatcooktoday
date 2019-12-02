<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class UsersController extends AppController {
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // allow this route/action
        $this->Auth->allow(['signup']);

    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function login() {
//        if ($this->Auth->user('id'))
        $a = false;
        if ($a)
        {
            // user already login
            return $this->redirect($this->Auth->redirectUrl());
        } else {
            // use form validation
            $login = $this->Users->newEntity();
            if($this->request->is('post') AND !empty($this->request->getData()) )
            {
                $check_login = $this->Users->patchEntity($login, $this->request->getData(), [
                    'validate' => 'login'
                ]);

                if($check_login->errors())
                {
                    // Form Validation TRUE
                    $this->Flash->error('Please Fill required fields');
                } else {
                    $user = $this->Auth->identify();
                    if ($user) {
                        $this->Auth->setUser($user);
//                        $this->Flash->success('Login success');
                        return $this->redirect($this->Auth->redirectUrl());
                    } else {
                        $this->Flash->error(__('Username or password is incorrect'));
                    }
                }
            }
            $this->set('login', $login);
        }
    }

    public function signup() {
        $sign_up = $this->Users->newEntity();

        if($this->request->is('post') AND !empty($this->request->getData()) ) {
            $signup = $this->Users->patchEntity($sign_up, $this->request->getData(), [
                'validate' => 'sign_up'
            ]);

            if($signup->errors()) {
                // Form Validation TRUE
                $this->Flash->error('Please Fill required fields');
            } else {
                $sign_up->username  = $this->request->getData('username');
                $sign_up->password  = $this->request->getData('password');
                $sign_up->email     = $this->request->getData('email');
                $sign_up->role      = 'user';

                // Form Validation FALSE
                if($this->Users->save($sign_up)) {
                    $this->Flash->success('User Added Successfully');
                    return $this->redirect(['action' => 'Signup']);
                }
                $this->Flash->error(__('Unable to add your user!'));
            }
        }
        $this->set('sign_up', $sign_up);
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }


}
