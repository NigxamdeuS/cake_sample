<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Employee;
use Cake\Http\Response;

/**
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class LoginController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Employees = $this->fetchTable('Employees');
    }

    public function index(): ?Response
    {
        $session = $this->request->getSession();
        if ($session->check('loginUser')) {
            return $this->redirect('/list');
        }

        $this->viewBuilder()->disableAutoLayout();

        return null;
    }

    public function login(): ?Response
    {
        $this->viewBuilder()->disableAutoLayout();
        $empIdText = (string)$this->request->getQuery('empId', '');
        $empPass = (string)$this->request->getQuery('empPass', '');

        $employee = $this->authenticate($empIdText, $empPass);
        if ($employee === null) {
            $this->set('empId', $empIdText);
            $this->set('errorMessage', '社員ID、またはパスワードが間違っています。');

            return $this->render('index');
        }

        $this->request->getSession()->write('loginUser', $employee);

        return $this->redirect('/list');
    }

    public function logout(): Response
    {
        $this->request->getSession()->destroy();

        return $this->redirect('/');
    }

    private function authenticate(string $empIdText, string $empPass): ?Employee
    {
        if ($empIdText === '' || $empPass === '') {
            return null;
        }

        if (!ctype_digit(trim($empIdText))) {
            return null;
        }

        $empId = (int)trim($empIdText);

        return $this->Employees->find()
            ->where([
                'emp_id' => $empId,
                'emp_pass' => trim($empPass),
            ])
            ->first();
    }
}
