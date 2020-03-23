<?php
declare(strict_types=1);
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{

    protected $_accessible = [
        'username' => true,
        'email' => true,
        'password' => true,
        'created' => true,
        'updated' => true,
        'created_by' => true,
        'status' => true,
        'is_delete' => true
    ];

    protected $_hidden = [
        'password',
        'is_delete'
    ];

    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }

        return null;
    }
}