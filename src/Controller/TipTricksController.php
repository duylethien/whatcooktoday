<?php
namespace App\Controller;

class TipTricksController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function display() {
        $this->paginate = [
            'limit'=> 20
        ];
        $recipes = $this->Recipes->find('all')->contain(['Users', 'Categories']);

        $recipes->select(['Recipes.recipe_id', 'Recipes.featured_image', 'Recipes.title', 'Recipes.difficulty', 'Recipes.permalink']);
        $recipes->select(['Users.firstname']);
        $recipes->select(['Categories.title']);
        $items = $this->paginate($recipes);

        $this->set(compact('items'));

        $this->set([
            'item' => $recipes,
            '_serialize' => ['item']
        ]);
    }

}
