<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateEmployeeManagement extends BaseMigration
{
    public function up(): void
    {
        if (!$this->hasTable('department')) {
            $this->table('department', ['id' => false])
                ->addColumn('dept_id', 'integer', ['null' => false])
                ->addColumn('dept_name', 'string', ['limit' => 30, 'null' => false])
                ->addPrimaryKey(['dept_id'])
                ->create();
        }

        if (!$this->hasTable('employee')) {
            $this->table('employee', ['id' => false])
                ->addColumn('emp_id', 'integer', [
                    'autoIncrement' => true,
                    'signed' => false,
                    'null' => false,
                ])
                ->addColumn('emp_pass', 'string', ['limit' => 16, 'null' => false])
                ->addColumn('emp_name', 'string', ['limit' => 30, 'null' => false])
                ->addColumn('gender', 'integer', ['null' => false, 'default' => 1])
                ->addColumn('address', 'string', ['limit' => 60, 'null' => false])
                ->addColumn('birthday', 'date', ['null' => false])
                ->addColumn('authority', 'integer', ['null' => false, 'default' => 1])
                ->addColumn('dept_id', 'integer', ['null' => false])
                ->addPrimaryKey(['emp_id'])
                ->addForeignKey('dept_id', 'department', 'dept_id')
                ->create();
        }

        $deptCount = $this->fetchRow('SELECT COUNT(*) AS cnt FROM department');
        if ($deptCount && (int)$deptCount['cnt'] === 0) {
            $this->table('department')->insert([
                ['dept_id' => 1, 'dept_name' => '営業部'],
                ['dept_id' => 2, 'dept_name' => '経理部'],
                ['dept_id' => 3, 'dept_name' => '総務部'],
            ])->saveData();
        }

        $empCount = $this->fetchRow('SELECT COUNT(*) AS cnt FROM employee');
        if ($empCount && (int)$empCount['cnt'] === 0) {
            $this->table('employee')->insert([
                [
                    'emp_pass' => 'systempt',
                    'emp_name' => '鈴木太郎',
                    'gender' => 1,
                    'address' => '東京都千代田区',
                    'birthday' => '1990-01-15',
                    'authority' => 1,
                    'dept_id' => 1,
                ],
                [
                    'emp_pass' => 'admin',
                    'emp_name' => '管理者',
                    'gender' => 1,
                    'address' => '東京都港区',
                    'birthday' => '1985-05-20',
                    'authority' => 2,
                    'dept_id' => 2,
                ],
            ])->saveData();
        }
    }

    public function down(): void
    {
        if ($this->hasTable('employee')) {
            $this->table('employee')->drop()->save();
        }
        if ($this->hasTable('department')) {
            $this->table('department')->drop()->save();
        }
    }
}
