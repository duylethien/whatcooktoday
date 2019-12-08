<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class RecipesController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        if ($this->Auth->user('user_id')) {
            $this->viewBuilder()->setLayout('user');
        }
    }

    public function index() {
        $this->set('title', 'Recipes');
        $this->paginate = [
            'limit'=> 20
        ];

        $title = $this->request->getQuery('title');
        $category = $this->request->getQuery('category');
        $filters = [];
        if (isset($title) && !empty($title)) {
            $filters['title'] = $title;
        }
        if (isset($category) && !empty($category)) {
            $filters['category'] = $category;
        }
        $recipes = $this->Recipes->find()
            ->contain(['Users', 'Categories'])
            ->where(['Recipes.status' => (\App\Model\Enum\EStatus::ACTIVE)]);

        foreach ($filters as $key => $val) {
            if (!isset($val)) {
                continue;
            }
            switch ($key) {
                case 'category':
                    $recipes->where(['Categories.permalink' => $val]);
                    break;
                case 'title':
                    $recipes->where(['LOWER(Recipes.title) LIKE' => '%'.strtolower($val).'%']);
                    break;
            }
        }
        if ($recipes->count() != 0) {
            $recipes->select(['Recipes.recipe_id', 'Recipes.featured_image', 'Recipes.title', 'Recipes.difficulty', 'Recipes.permalink']);
            $recipes->select(['Users.firstname', 'Users.image', 'Users.user_id']);
            $recipes->select(['Categories.title']);
            $items = $this->paginate($recipes);
        } else {
            $items = null;
        }

        $this->set(compact('items'));

        $this->set([
            'item' => $recipes,
            'filters' => $filters,
            '_serialize' => ['item', 'filters' ]
        ]);
    }

    public function detail($permalink) {
        $Recipes = TableRegistry::getTableLocator()->get('Recipes');
        $recipes = $Recipes->find()
            ->where(['Recipes.permalink' => $permalink])
            ->andWhere(['Recipes.status' => (\App\Model\Enum\EStatus::ACTIVE)])
            ->contain(['Users', 'Categories']);
        foreach ($recipes as $item) {
            $recipe = $item;
        }

        $popular_recipes = $Recipes->find()
            ->contain(['Categories'])
            ->where(['Recipes.status' => (\App\Model\Enum\EStatus::ACTIVE)])
            ->limit(4)
            ->order(['visited' => 'DESC']);
        $popular_recipes->select(['Recipes.recipe_id', 'Recipes.featured_image', 'Recipes.title', 'Recipes.visited', 'Recipes.permalink']);
        $popular_recipes->select(['Categories.title']);

        $this->set(compact('recipe', 'popular_recipes'));

        $this->set([
            'recipe' => $recipe,
            '_serialize' => ['recipe']
        ]);
//        $this->RequestHandler->renderAs($this, 'json');
    }

    public function manage() {

    }

    public function add() {
        $this->set('title', 'Add Recipes');

        /**
         *  Insert Recipes
         */
        $recipes = $this->Recipes->newEntity();

        // check post request and data
        if($this->request->is('post') AND !empty($this->request->getData()) )
        {

            $recipes = $this->Recipes->patchEntity($recipes, $this->request->getData(), [
                'validate' => true
            ]);

            // insert user id in recipes id
            $recipes->user_id = $this->Auth->user('user_id'); // $this->request->session()->read('Auth.User.id')

            if ($recipes->errors()) {
                // Form Validation TRUE
                $this->Flash->error('Please Fill required fields');
            } else {
                // Form Validation FALSE
                if ($this->Recipes->save($recipes))
                {
                    $this->redirect('/recipes/add');
                    $this->Flash->success('Recipes Add Successfully');
                }else{
                    $this->Flash->error(__('Unable to add your recipes!'));
                }
            }
        }
        $this->set(compact('recipes'));
        $this->set('_serialize', ['recipes']);
    }

    public function edit($id) {
        if (!isset($id)) {
            return $this->redirect('/my-recipes');
        }

        // set title
        $this->set('title', 'Edit Recipes');
        $Recipes = TableRegistry::getTableLocator()->get('Recipes');

        // get article
        $recipes = $Recipes->get($id,[
            'conditions' => ['user_id' => $this->request->getSession()->read('Auth.User.user_id')],
        ]);

        // update article
        if($this->request->is('put') AND !empty($this->request->getData()))
        {
            $recipes->accessible('user_id', FALSE);
            $recipes->accessible('id', FALSE);

            $update_recipe = $Recipes->patchEntity($recipes, $this->request->getData(), [
                'validate' => 'update_article'
            ]);

            $update_recipe->title  = $this->request->getData('title');
            $update_recipe->permalink   = $this->request->getData('permalink');

            // check validation errors
            if($update_recipe->errors())
            {
                $this->Flash->error(__('Please Fill required fields'));
            }else{
                // Form Validation FALSE
                if($Recipes->save($update_recipe))
                {
                    // update success
                    $this->Flash->success(__('Your Recipes has been Updated.'));
                    // $this->redirect('/Recipes/Edit/'.$eid);
                }else{
                    // update server error
                    $this->Flash->error(__('Unable to update article!'));
                }
            }
        }

        // set data in template
        $this->set(compact('recipes'));
        $this->set('_serialize', ['recipes']);
    }

    public function delete($id) {
        if(!isset($id))
            return $this->redirect('/my-recipes');

        $this->request->allowMethod(['post', 'delete']);

        $Recipes = TableRegistry::getTableLocator()->get('Recipes');

        // get article
        $recipe = $Recipes->get($id,[
            'conditions' => ['user_id' => $this->request->getSession()->read('Auth.User.user_id')],
        ]);

        if ($Recipes->delete($recipe))
        {
            $this->Flash->success(__('The article with id: {0} has been deleted.', h($id)));
            return $this->redirect('/my-recipes');
        }
    }

    public function search() {
//        $this->request->allowMethod('ajax');
        $this->viewBuilder()->setLayout('format');
        $keyword = $this->request->getQuery('keyword');
        $Recipes = TableRegistry::getTableLocator()->get('Recipes');
        $query = $Recipes->find('all',[
            'conditions' => ['title LIKE'=>'%'.$keyword.'%'],
            'order' => ['Recipes.recipe_id'=>'DESC'],
            'limit' => 10
        ]);
        $this->set('recipes', $this->paginate($query));
        $this->set('_serialize', ['recipes']);
    }

}
