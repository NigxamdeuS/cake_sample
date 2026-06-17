<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EmployeesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('employee');
        $this->setDisplayField('emp_name');
        $this->setPrimaryKey('emp_id');

        $this->belongsTo('Departments', [
            'foreignKey' => 'dept_id',
            'bindingKey' => 'dept_id',
            'joinType' => 'LEFT',
        ]);

        $this->getSchema()->setColumnType('birthday', 'date');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('emp_pass')
            ->maxLength('emp_pass', 16, 'パスワードは16文字以内で入力してください')
            ->requirePresence('emp_pass', 'create')
            ->notEmptyString('emp_pass', 'パスワードを入力してください');

        $validator
            ->scalar('emp_name')
            ->maxLength('emp_name', 30, '社員名は30文字以内で入力してください')
            ->requirePresence('emp_name', 'create')
            ->notEmptyString('emp_name', '社員名を入力してください');

        $validator
            ->scalar('address')
            ->maxLength('address', 60, '住所は60文字以内で入力してください')
            ->requirePresence('address', 'create')
            ->notEmptyString('address', '住所を入力してください');

        $validator
            ->add('birthday', 'birthdayRequired', [
                'rule' => function ($value): bool {
                    if ($value instanceof \DateTimeInterface) {
                        return true;
                    }

                    return is_string($value) && trim($value) !== '';
                },
                'message' => '生年月日を入力してください',
                'on' => 'create',
            ])
            ->requirePresence('birthday', 'create');

        $validator
            ->integer('dept_id')
            ->requirePresence('dept_id', 'create')
            ->notEmptyString('dept_id', '部署を選択してください');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['dept_id'], 'Departments'), ['errorField' => 'dept_id']);

        return $rules;
    }
}
