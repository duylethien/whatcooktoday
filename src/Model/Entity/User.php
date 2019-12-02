<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;


class User extends Entity
{
    protected $_accessible = [
        ' * ' => true,
        'user_id'    => false,
        'email' => false,
        'password' => false,
    ];

    /**
     *  User Password Hash
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($password);
            // return (new DefaultPasswordHasher)->hash($password);
        }
    }

    protected function _getEId()
    {
        // load hashid config
        $hashids = new Hashids(Configure::read('Hashid.key'), Configure::read('Hashid.length'), Configure::read('Hashid.characters'));
        return $hashids->encodeHex($this->_properties['id']);
    }
}
