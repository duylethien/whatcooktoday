<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class CategoriesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->setPrimaryKey('category_id');
        $this->hasOne('Icons')
            ->setBindingKey('icon_id')
            ->setForeignKey('icon_id');
    }
}
