<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * @property int $emp_id
 * @property string $emp_pass
 * @property string $emp_name
 * @property int $gender
 * @property string $address
 * @property \Cake\I18n\Date $birthday
 * @property int $authority
 * @property int $dept_id
 * @property \App\Model\Entity\Department|null $department
 */
class Employee extends Entity
{
    protected array $_accessible = [
        'emp_pass' => true,
        'emp_name' => true,
        'gender' => true,
        'address' => true,
        'birthday' => true,
        'authority' => true,
        'dept_id' => true,
        'department' => true,
    ];
}
