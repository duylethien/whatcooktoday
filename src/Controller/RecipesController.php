<?php
namespace App\Controller;

class RecipesController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        if ($this->Auth->user('user_id')) {
            $this->viewBuilder()->setLayout('user');
        }
    }

    public function display($category) {
        $this->set('title', 'Recipessss');
        $this->paginate = [
            'limit'=> 20
        ];
        if ($category == 'all') {
            $recipes = $this->Recipes->find('all')->contain(['Users', 'Categories']);
        } else {
            $recipes = $this->Recipes->find()
                ->contain(['Users', 'Categories'])
                ->where(['Categories.permalink' => $category])
                ->andWhere(['Recipes.status' => 'active']);
        }

        $recipes->select(['Recipes.recipe_id', 'Recipes.featured_image', 'Recipes.title', 'Recipes.difficulty', 'Recipes.permalink']);
        $recipes->select(['Users.firstname', 'Users.image']);
        $recipes->select(['Categories.title']);
        $items = $this->paginate($recipes);

        $this->set(compact('items'));

        $this->set([
            'item' => $recipes,
            '_serialize' => ['item']
        ]);
    }

    public function detail($permalink) {
        $item = $this->Recipes->find()
            ->where(['Recipes.permalink' => $permalink])
            ->andWhere(['Recipes.status' => 'active'])
            ->contain(['Users', 'Categories']);

        $this->set(compact('item'));

        $this->set([
            'item' => $item,
            '_serialize' => ['item']
        ]);
//        $this->RequestHandler->renderAs($this, 'json');
    }


    public function getListRecipePosts() {
        $this->paginate = [
            'limit'=> 20
        ];

//        $recipes = $this->Recipes->find('all')->contain(['Users', 'Categories'])->hydrate(false);
        $recipes = $this->Recipes->find('all')->contain(['Users', 'Categories']);
        $recipes->select(['Recipes.recipe_id', 'Recipes.featured_image', 'Recipes.title', 'Recipes.difficulty']);
        $recipes->select(['Users.firstname']);
        $recipes->select(['Categories.title']);
        $recipes = $this->paginate($recipes);

        $this->set([
            'items' => $recipes,
            '_serialize' => ['items']
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }
}
