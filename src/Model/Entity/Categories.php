<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Categories extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

}
