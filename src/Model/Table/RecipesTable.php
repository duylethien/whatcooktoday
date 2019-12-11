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
            ->numeric('category_id','Please enter numeric values')
            ->notEmptyString('title')
            ->lengthBetween('title', [8, 100], 'Allow only Min 8 and Max 100 characters')
            ->notEmptyString('permalink')
            ->lengthBetween('permalink', [8, 1000], 'Allow only Min 8 and Max 1000 characters')
            ->numeric('difficulty','Please enter numeric values')
            ->lengthBetween('difficulty', [1, 1], 'Allow only 1 characters')
            ->allowEmptyString('prepare_time')
            ->allowEmptyString('cooking_time')
            ->allowEmptyString('calories')
//            ->numeric('calories','Vui lòng nhập số')
            ->notEmptyString('description')
            ->lengthBetween('description', [8, 1000], 'Allow only Min 8 and Max 1000 characters')
            ->notEmptyString('directions')
            ->lengthBetween('directions', [8, 1000], 'Allow only Min 8 and Max 1000 characters')
            ->notEmptyString('ingredients')
            ->lengthBetween('ingredients', [8, 1000], 'Allow only Min 8 and Max 1000 characters')
            ->numeric('status','Please enter numeric values')
            ->lengthBetween('status', [1, 1], 'Allow only 1 characters');

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
