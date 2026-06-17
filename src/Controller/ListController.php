<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

/**
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class ListController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Employees = $this->fetchTable('Employees');
    }

    public function index(): ?Response
    {
        $loginUser = $this->getLoginUser();
        if ($loginUser === null) {
            return $this->redirect('/');
        }

        $this->viewBuilder()->disableAutoLayout();
        $this->viewBuilder()->setTemplate('list');

        $empName = (string)$this->request->getQuery('empName', '');
        $searched = trim($empName) !== '';

        $query = $this->Employees->find()->contain(['Departments']);
        if ($searched) {
            $query->where(['Employees.emp_name LIKE' => '%' . trim($empName) . '%']);
        }

        $employeeList = $query->all()->toList();
        $noResult = $searched && $employeeList === [];

        $this->set(compact('loginUser', 'employeeList', 'empName', 'searched', 'noResult'));

        return null;
    }

    public function delete(): Response
    {
        $this->request->allowMethod(['post']);

        $empId = (int)$this->request->getData('empId', 0);
        if ($empId > 0) {
            $employee = $this->Employees->get($empId);
            $this->Employees->delete($employee);
        }

        return $this->redirect('/list');
    }
}
