<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class RecipesController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        if ($this->Auth->user('user_id')) {
            $this->viewBuilder()->setLayout('admin');
        }
    }

    public function index() {

    }

}
