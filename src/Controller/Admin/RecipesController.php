<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class RecipesController extends AppController {

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function index() {
        $this->set('title', 'Manage Recipes');

        $this->paginate = [
            'limit'=> 15
        ];
        $Recipes = TableRegistry::getTableLocator()->get('Recipes');
        $recipes = $Recipes->find()
            ->contain(['Users', 'Categories']);

        $recipes->select(['Recipes.recipe_id', 'Recipes.status', 'Recipes.title']);
        $recipes->select(['Users.email']);
        $recipes->select(['Categories.title']);

        $items = $this->paginate($recipes);

        $this->set(compact('items'));

        $this->set([
            'item' => $recipes,
            '_serialize' => ['item']
        ]);
    }

    public function add() {
        $this->set('title', 'Add Recipes');
        $Categories = TableRegistry::getTableLocator()->get('Categories');
        $categories = $Categories->find('all');

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
                    $this->redirect('/admin/recipes');
                    $this->Flash->success('Recipes Add Successfully');
                }else{
                    $this->Flash->error(__('Unable to add your recipes!'));
                }
            }
        }
        $this->set(compact('recipes'));
        $this->set(compact('recipes', 'categories'));
        $this->set([
            'recipes' => $recipes,
            'categories' => $categories,
            '_serialize' => ['recipes', 'categories']
        ]);
    }

    public function edit($id = null) {
        if (!isset($id)) {
            return $this->redirect('/admin/recipes');
        }

        // set title
        $this->set('title', 'Edit Recipes');
        $Categories = TableRegistry::getTableLocator()->get('Categories');
        $categories = $Categories->find('all');

        $Recipes = TableRegistry::getTableLocator()->get('Recipes');

        // get article
        $recipes = $Recipes->get($id);

        // update article
        if($this->request->is('put') AND !empty($this->request->getData()))
        {
            $recipes->accessible('user_id', FALSE);
            $recipes->accessible('id', FALSE);

            $update_recipe = $Recipes->patchEntity($recipes, $this->request->getData(), [
                'validate' => true
            ]);

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
        $this->set(compact('recipes', 'categories'));
//        $this->set('_serialize', ['recipes', 'categories']);
        $this->set([
            'recipes' => $recipes,
            'categories' => $categories,
            '_serialize' => ['recipes', 'categories']
        ]);
    }

    public function delete($id = null) {
        if(!isset($id))
            return $this->redirect('/admin/recipes');

        $this->request->allowMethod(['post', 'delete']);

        $Recipes = TableRegistry::getTableLocator()->get('Recipes');

        // get article
        $recipe = $Recipes->get($id,[
            'conditions' => ['user_id' => $this->request->getSession()->read('Auth.User.user_id')],
        ]);

        if ($Recipes->delete($recipe))
        {
            $this->Flash->success(__('The article with title: {0} has been deleted.', h($recipe->title)));
            return $this->redirect('/admin/recipes');
        }
    }

}
