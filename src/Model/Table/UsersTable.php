<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->setPrimaryKey('user_id');
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email'], 'Email Already Exists'));
        $rules->add($rules->isUnique(['username'], 'Username Already Exists'));
        return $rules;
    }

    public function validationLogin(Validator $validator)
    {
        $validator
            // User Email Validation
            ->add('email', 'valid', [
                'rule' => 'email',
                'message' => 'Please enter valid email'
            ])
            // User Password Validation
            ->notEmptyString('password');

        return $validator;
    }

    public function validationSign_up(Validator $validator)
    {
        $validator
//            // User Funll Name Validation
//            ->notEmptyString('name')
            // Username Validation
            ->notEmptyString('username')
            ->lengthBetween('username', [4, 12])
            // User Email Validation
            ->add('email', 'valid', [
                'rule' => 'email',
                'message' => 'Please enter valid email'
            ])
            // User Password Validation
            ->notEmptyString('password')
            ->notEmptyString('confirm_password')
            ->add('confirm_password', 'no-misspelling', [
                'rule' => ['compareWith', 'password'],
                'message' => 'Passwords are not equal',
            ]);
//            // User Phone Validation
//            ->numeric('phone','Please enter numeric values')
//            ->lengthBetween('phone', [10, 10], 'Allow only 10 characters')
//            // User Zipcode Validation
//            ->notEmptyString('zipcode')
//            ->numeric('zipcode','Please enter numeric values');

        return $validator;
    }
}
