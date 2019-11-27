<?php
namespace App\Controller;

class RecipesController extends AppController {
    public function index() {
        $this->loadComponent('Paginator');
        $recipes = $this->Paginator->paginate($this->Recipes->find());
        $this->set(compact('recipes'));
    }
    public function display() {
        $this->paginate = [
            'limit'=> 20
        ];

//        $recipes = $this->Recipes->find('all')->contain(['Users', 'Categories'])->hydrate(false);
        $recipes = $this->Recipes->find('all')->contain(['Users', 'Categories']);
        $recipes->select(['Recipes.recipe_id', 'Recipes.featured_image', 'Recipes.title', 'Recipes.difficulty']);
        $recipes->select(['Users.firstname']);
        $recipes->select(['Categories.title']);
        $items = $this->paginate($recipes);

        $this->set(compact('items'));
    }

    public function getListRecipePosts() {

    }
}
