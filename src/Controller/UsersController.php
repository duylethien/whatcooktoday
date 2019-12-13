<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use PhpParser\Node\Expr\Cast\Object_;

class UsersController extends AppController {
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // allow this route/action
        $this->Auth->allow(['signup', 'view']);
        if ($this->Auth->user('user_id')) {
            $this->viewBuilder()->setLayout('user');
        } else {
            $this->viewBuilder()->setLayout('default');
        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function login() {
        if ($this->Auth->user('user_id')) {
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
                $sign_up->firstname  = $this->request->getData('firstname');
                $sign_up->password  = $this->request->getData('password');
                $sign_up->email     = $this->request->getData('email');
                $sign_up->usergroup_id = 2;
                $sign_up->status = 1;

                // Form Validation FALSE
                if($this->Users->save($sign_up)) {
                    $this->Flash->success('User Added Successfully');
                    return $this->redirect(['action' => 'login']);
                }
                $this->Flash->error(__('Unable to add your user!'));
            }
        }
        $this->set('sign_up', $sign_up);
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function profile($id) {
        $this->set('title', 'My Recipes');

        $this->paginate = [
            'limit'=> 9
        ];
        $Recipes = TableRegistry::getTableLocator()->get('Recipes');
        $recipes = $Recipes->find()
            ->contain(['Users', 'Categories'])
            ->where(['Recipes.user_id' => $id])
            ->andWhere(['Recipes.status' => (\App\Model\Enum\EStatus::ACTIVE)])
            ->order(['Recipes.created' => 'DESC']);

        $recipes->select(['Recipes.recipe_id', 'Recipes.featured_image', 'Recipes.title', 'Recipes.difficulty', 'Recipes.permalink']);
        $recipes->select(['Users.firstname', 'Users.image']);
        $recipes->select(['Categories.title']);

        /////////////////////////////////

        $Users = TableRegistry::getTableLocator()->get('Users');
        $infoUser = $Users->find()
            ->where(['Users.user_id' => $id])
            ->andWhere(['Users.status' => (\App\Model\Enum\EStatus::ACTIVE)])
            ->first();

        $test= $infoUser['visited'];
        $test++;
        $infoUser['visited'] = $test;
        $Users->save($infoUser);
//        $infoUser->select([
//            'Users.firstname',
//            'Users.lastname',
//            'Users.username',
//            'Users.email',
//            'Users.visited',
//            'Users.description',
//            'Users.image',
//            'Users.usergroup_id',
//            'Users.gender',
//        ]);
//        foreach ($infoUser as $item) {
//            $infoUser = $item;
//        }
        $infoUser['sum_recipe'] = $recipes->count();

        $items = $this->paginate($recipes);

        $this->set(compact('infoUser', 'items'));

        $this->set([
            'item' => $recipes,
            'info' => $infoUser,
            '_serialize' => ['info', 'item']
        ]);
    }

    public function dashboard() {
        $file = $this->request->getData(['file']);

        $this->set('title', 'Dashboard');
        $this->viewBuilder()->setLayout('user');
        $this->set('user', $this->request->getSession()->read('Auth.User'));

        /**
         * User Profile Update
         */
        $Users = TableRegistry::getTableLocator()->get('Users');

        $user_data = $Users->get($this->request->getSession()->read('Auth.User.user_id'));
        if($this->request->is('put') AND !empty($this->request->getData()) )
        {
            $userdata = $Users->patchEntity($user_data, $this->request->getData(), [
                'validate' => 'update_profile'
            ]);

            if ($userdata->errors()) {
                // Form Validation TRUE
                $this->Flash->error('Please Fill required fields');
            } else {
                /**
                 * neu co nhap de thay doi mk (ca 3 tr deu co thi moi doi mat khau)
                 */
                $pass['password'] = $this->request->getData('password_new');
                $pass['password_re'] = $this->request->getData('password_re');
                if (!(empty($pass['password']) && empty($pass['password_re']))) {
                    if ( $pass['password'] ==  $pass['password_re']) {
                        $user_data->password = $pass['password'];
                    } else {
                        $this->Flash->error(__('Hai mat khau khong trung!'));
                        return;
                    }
                }
                $user_data->username    = $this->request->getData('username');
                $user_data->firstname   = $this->request->getData('firstname');
                $user_data->lastname = $this->request->getData('lastname');
                $user_data->description = $this->request->getData('description');
                $user_data->gender = $this->request->getData('gender');

                if (!empty($file['tmp_name'])) {
                    try {
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/users/' . $file['name']);
                        $user_data->image = $file['name'];
                        $this->request->getSession()->write('Auth.User.image', $file['name']);
                    } catch (\Exception $e) {
                        $this->Flash->error($e);
                    }
                }

                // Form Validation FALSE
                if ($Users->save($user_data)) {
                    // User Session Update
                    $this->request->getSession()->write('Auth.User.username', $user_data['username']);
                    $this->request->getSession()->write('Auth.User.firstname', $user_data['firstname']);
                    $this->request->getSession()->write('Auth.User.lastname', $user_data['lastname']);
                    $this->request->getSession()->write('Auth.User.description', $user_data['description']);
                    $this->request->getSession()->write('Auth.User.gender', $user_data['gender']);
                    $this->redirect('/dashboard');
                    $this->Flash->success(__d('profile', 'user has been updated'));
                }else{
                    $this->Flash->error(__('Unable to update user!'));
                }
            }
        }
        $this->set(compact('user_data'));
        $this->set('_serialize', ['user_data']);
    }

    public function manage() {
        $this->set('title', 'My Recipes');

        $this->paginate = [
            'limit'=> 7
        ];

        $user = $this->request->getSession()->read('Auth.User');

        $Recipes = TableRegistry::getTableLocator()->get('Recipes');
        $recipes = $Recipes->find()
            ->contain(['Categories'])
            ->where(['Recipes.user_id' => $user['user_id']])
            ->order(['Recipes.created' => 'DESC']);

        $recipes->select(['Recipes.recipe_id', 'Recipes.featured_image', 'Recipes.title', 'Recipes.status', 'Recipes.permalink']);
        $recipes->select(['Categories.title']);

        $items = $this->paginate($recipes);

        $this->set(compact('user', 'items'));
        $this->set('_serialize', ['user', 'items']);
    }

}
