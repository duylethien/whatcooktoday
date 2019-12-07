<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class HomeController extends AppController {
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['i', 'home']);
        if ($this->Auth->user('user_id')) {
            $this->viewBuilder()->setLayout('default');
        } else {
            $this->viewBuilder()->setLayout('default');
        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index() {
        $this->set('title', 'Home');

        $Users = TableRegistry::getTableLocator()->get('Users');
        $users = $Users->find()
            ->where(['status' => (\App\Model\Enum\EStatus::ACTIVE)])
            ->limit(9)
            ->order(['visited' => 'DESC']);

        $Recipes = TableRegistry::getTableLocator()->get('Recipes');
        $new_recipes = $Recipes->find()
            ->contain(['Users', 'Categories'])
            ->where(['Recipes.status' => (\App\Model\Enum\EStatus::ACTIVE)])
            ->limit(18);
        if ($new_recipes->count() != 0) {
            $new_recipes->select(['Recipes.recipe_id', 'Recipes.featured_image', 'Recipes.title', 'Recipes.difficulty', 'Recipes.permalink']);
            $new_recipes->select(['Users.firstname', 'Users.image', 'Users.user_id']);
            $new_recipes->select(['Categories.title']);
            $items = $new_recipes;
        } else {
            $items = null;
        }

        $popular_recipes = $Recipes->find()
            ->contain(['Categories'])
            ->where(['Recipes.status' => (\App\Model\Enum\EStatus::ACTIVE)])
            ->limit(4)
            ->order(['visited' => 'DESC']);
        $popular_recipes->select(['Recipes.recipe_id', 'Recipes.featured_image', 'Recipes.title', 'Recipes.visited', 'Recipes.permalink']);
        $popular_recipes->select(['Categories.title']);

        $this->set(compact('items', 'users'));

        $this->set([
            'item' => $new_recipes,
            'users' => $users,
            'popular_recipes' => $popular_recipes,
            '_serialize' => ['item', 'users', 'popular_recipes']
        ]);
    }

    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}
