<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class RecipesTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasOne('Users')
            ->setBindingKey('user_id')
            ->setForeignKey('user_id');

        $this->hasOne('Categories')
            ->setBindingKey('category_id')
            ->setForeignKey('category_id');
    }
}
