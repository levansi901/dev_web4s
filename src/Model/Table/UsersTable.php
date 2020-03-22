<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Table;


class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'updated' => 'always'
                ]
            ]
        ]);
    }
}