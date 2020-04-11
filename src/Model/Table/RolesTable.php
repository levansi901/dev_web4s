<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Controller\Component;

class RolesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        return $validator;
    }

    public function getListRoles($params = [])
    {   
        $table = TableRegistry::getTableLocator()->get('Roles');

        // param query
        $type = !empty($params['type']) ? $params['type'] : ALL;
        if(!in_array($type, [ALL, LIST_TYPE])){
            $type = ALL;
        }

        $is_pagination = !empty($params['is_pagination']) ? 1 : 0;        
        $page = !empty($params['page']) ? intval($params['page']) : 1;
        $limit = !empty($params['limit']) ? $params['limit'] : PAGINATION_LIMIT_ADMIN;

        // filter
        $filter = !empty($params['filter']) ? $params['filter'] : [];
        $conditions = ['is_delete' => 0];

        $keyword = !empty($filter['keyword']) ? trim($filter['keyword']) : null;
        if (!empty($keyword)) {
            $conditions['name LIKE'] = '%' . $keyword . '%';
        }

        // build query
        $query = $table->find($type)->where($conditions)->order(['id' => 'DESC'])->limit($limit)->page($page);
        if(!empty($is_pagination)){
            return $query;
        }
        return $query->toList();
    }

}