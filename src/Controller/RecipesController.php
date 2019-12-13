<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class RecipesController extends AppController {
//    public function beforeFilter(\Cake\Event\Event $event)
//    {
////        parent::beforeFilter($event);
////
////        if ($this->request->param('action') === 'imageUpload') {
////            $this->eventManager()->off($this->Csrf);
////        }
//
//        $this->getEventManager()->off($this->Csrf);
//    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
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
        $recipe = $Recipes->find()
            ->where(['Recipes.permalink' => $permalink])
            ->andWhere(['Recipes.status' => (\App\Model\Enum\EStatus::ACTIVE)])
            ->contain(['Users', 'Categories'])
            ->first();

        //count visited
        $test= $recipe['visited'];
        $test++;
        $recipe['visited'] = $test;
        $Recipes->save($recipe);

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

    public function add() {
        $this->set('title', 'Add Recipes');
        $this->set('user', $this->request->getSession()->read('Auth.User'));

        $Categories = TableRegistry::getTableLocator()->get('Categories');
        $categories = $Categories->find('all');

        /**
         *  Insert Recipes
         */
        $recipes = $this->Recipes->newEntity();

        // check post request and data
        if($this->request->is('post') AND !empty($this->request->getData()) ) {
            $recipes = $this->Recipes->patchEntity($recipes, $this->request->getData(), [
                'validate' => 'default'
            ]);

            // insert user id in recipes id
            $recipes->user_id = $this->Auth->user('user_id'); // $this->request->session()->read('Auth.User.id')
            $recipes->gallery = json_encode($_POST["gallery"]);

            if ($recipes->errors()) {
                // Form Validation TRUE
                $this->Flash->error('Please Fill required fields');
            } else {
                $file = $this->request->getData(['featured_image']);
                if (!empty($file['tmp_name'])) {
                    try {
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/recipes/' . $file['name']);
                        $recipes->featured_image = $file['name'];
                    } catch (\Exception $e) {
                        $this->Flash->error($e);
                    }
                }
                // Form Validation FALSE
                if ($this->Recipes->save($recipes)) {
                    $this->redirect('/recipes/add');
                    $this->Flash->success('Recipes Add Successfully');
                } else {
                    $this->Flash->error(__('Unable to add your recipes!'));
                }
            }
        }
        $this->set(compact('recipes', 'categories'));
        $this->set([
            'recipes' => $recipes,
            'categories' => $categories,
            '_serialize' => ['recipes', 'categories']
        ]);
    }

    public function edit($id) {
        if (!isset($id)) {
            return $this->redirect('/my-recipes');
        }
        $this->set('user', $this->request->getSession()->read('Auth.User'));

        // set title
        $this->set('title', 'Edit Recipes');
        $Recipes = TableRegistry::getTableLocator()->get('Recipes');

        $Categories = TableRegistry::getTableLocator()->get('Categories');
        $categories = $Categories->find('all');

        // get article
        $recipes = $Recipes->get($id);

        // update article
        if($this->request->is('put') AND !empty($this->request->getData()))
        {
            $recipes->accessible('user_id', FALSE);
            $recipes->accessible('id', FALSE);

            $update_recipe = $Recipes->patchEntity($recipes, $this->request->getData(), [
                'validate' => 'default'
            ]);

            if($update_recipe->errors()) {
                $this->Flash->error(__('Please Fill required fields'));
            } else {
                $update_recipe->category_id  = $this->request->getData('category_id');
                $update_recipe->title  = $this->request->getData('title');
                $update_recipe->permalink   = $this->request->getData('permalink');
                $update_recipe->difficulty   = $this->request->getData('difficulty');
                $update_recipe->preapare_time   = $this->request->getData('preapare_time');
                $update_recipe->cooking_time   = $this->request->getData('cooking_time');
                $update_recipe->serves   = $this->request->getData('serves');
                $update_recipe->calories   = $this->request->getData('calories');
                $update_recipe->description   = $this->request->getData('description');
                $update_recipe->status   = $this->request->getData('status');
                $update_recipe->video   = $this->request->getData('video');
                $update_recipe->directions    = $this->request->getData('directions');
                $update_recipe->ingredients    = $this->request->getData('ingredients');
                $update_recipe->meta_description    = $this->request->getData('meta_description');
                $update_recipe->gallery = json_encode($_POST["gallery"]);

                $file = $this->request->getData(['featured_image']);
                if (!empty($file['tmp_name'])) {
                    try {
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/recipes/' . $file['name']);
                        $update_recipe->featured_image = $file['name'];
                    } catch (\Exception $e) {
                        $this->Flash->error($e);
                    }
                }

                if ($Recipes->save($update_recipe)) {
                    $this->Flash->success(__('Your Recipes has been Updated.'));
                }else{
                    $this->Flash->error(__('Unable to update article!'));
                }
            }
        }

        $this->set(compact('recipes', 'categories'));
        $this->set([
            'recipes' => $recipes,
            'categories' => $categories,
            '_serialize' => ['recipes', 'categories']
        ]);
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

    public function imageUpload() {
        $files = $this->request->getData(['file']);
        $passed_files=[];
        $errors = 0;
//        dd($file);
        foreach ($files as $idx => $file) {
            if (!empty($file['tmp_name'])) {
                try {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/recipes/' . "IRecipes_".$file['name']);
                    $passed_files[] = "IRecipes_" . $file['name'];
                } catch (\Exception $e) {
                    $errors++;
                }
            }
        }
        if ($errors == count($files))
            die(json_encode(["error" => true, "message" => 'lỗi rồi']));
        else
            die(json_encode(["error" => false, "files" => $passed_files]));
    }

}
