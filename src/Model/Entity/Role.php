<?php
declare(strict_types=1);
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Role extends Entity
{

    protected $_hidden = [
        'is_delete'
    ];

}