<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class DepartmentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('department');
        $this->setDisplayField('dept_name');
        $this->setPrimaryKey('dept_id');

        $this->hasMany('Employees', [
            'foreignKey' => 'dept_id',
            'bindingKey' => 'dept_id',
        ]);
    }
}
