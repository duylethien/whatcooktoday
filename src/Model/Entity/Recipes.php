<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Recipes extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

}
