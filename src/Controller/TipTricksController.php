<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class TipTricksController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        if ($this->Auth->user('user_id')) {
            $this->viewBuilder()->setLayout('user');
        }
    }

    public function index() {
        $this->paginate = [
            'limit'=> 8
        ];

        $Blogs = TableRegistry::getTableLocator()->get('Blogs');
        $blogs = $Blogs->find('all');
        $items = $this->paginate($blogs);

        $popular = $Blogs->find()
            ->limit(8)
            ->order(['visits' => 'DESC']);

        $this->set(compact('items', 'popular'));

        $this->set([
            'items' => $blogs,
            '_serialize' => ['items']
        ]);
    }

    public function detail($permalink) {
        $Blogs = TableRegistry::getTableLocator()->get('Blogs');
        $tricks = $Blogs->find()
            ->where(['permalink' => $permalink]);
        foreach ($tricks as $val) {
            $item = $val;
        }

        $popular = $Blogs->find()
            ->limit(8)
            ->order(['visits' => 'DESC']);

        $this->set(compact('item', 'popular'));
    }

}
