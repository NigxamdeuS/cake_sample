<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * @property int $dept_id
 * @property string $dept_name
 */
class Department extends Entity
{
    protected array $_accessible = [
        'dept_name' => true,
    ];
}
