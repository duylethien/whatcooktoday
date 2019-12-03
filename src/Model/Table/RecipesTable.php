<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RecipesTable extends Table
{
    public function initialize(array $config)
    {
        $this->setPrimaryKey('recipe_id');
        $this->hasOne('Users')
            ->setBindingKey('user_id')
            ->setForeignKey('user_id');

        $this->hasOne('Categories')
            ->setBindingKey('category_id')
            ->setForeignKey('category_id');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmptyString('title')
            ->lengthBetween('title', [8, 100], 'Allow only Min 8 and Max 100 characters')
            ->notEmptyString('permalink')
            ->lengthBetween('permalink', [8, 1000], 'Allow only Min 8 and Max 1000 characters');

        return $validator;
    }

    public function validationUpdate_article(Validator $validator)
    {
        $validator
            ->notEmptyString('title')
            ->lengthBetween('title', [8, 100], 'Allow only Min 8 and Max 100 characters')
            ->notEmptyString('permalink')
            ->lengthBetween('permalink', [8, 100], 'Allow only Min 8 and Max 100 characters');

        return $validator;
    }
}
