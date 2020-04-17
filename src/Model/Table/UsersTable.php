<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use App\Model\Behavior\UnixTimestampBehavior;
use Cake\ORM\Rule\IsUnique;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('users');

        $this->setDisplayField('full_name');

        $this->addBehavior('UnixTimestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'updated' => 'existing'
                ]
            ]
        ]);

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('email')
            ->maxLength('email', 255)
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        return $validator;
    }

    public function getListUsers()
    {
        $table = TableRegistry::getTableLocator()->get('Users');
        $list = $table->find()->order(['id' => 'DESC'])->toArray();
        return $list;
    }

    public function checkExistEmail($email = null){
        if(empty($email)) return false;

        $table = TableRegistry::getTableLocator()->get('Users');
        $user = $table->find()->where(['email' => $email, 'is_delete' => 0])->first();

        return !empty($user->id) ? true : false;
    }

    public function checkExistUsername($username = null){
        if(empty($username)) return false;

        $table = TableRegistry::getTableLocator()->get('Users');
        $user = $table->find()->where(['username' => $username, 'is_delete' => 0])->first();
        return !empty($user->id) ? true : false;
    }

}