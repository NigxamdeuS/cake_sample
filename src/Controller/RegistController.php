<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Employee;
use App\Service\EmployeeRegistService;
use Cake\Http\Response;

/**
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class RegistController extends AppController
{
    private const SESSION_FORM_KEY = 'Regist.employeeForm';

    public function initialize(): void
    {
        parent::initialize();
        $this->Employees = $this->fetchTable('Employees');
    }

    public function input(): ?Response
    {
        $this->viewBuilder()->disableAutoLayout();
        $this->viewBuilder()->setTemplate('input');

        if ($this->request->is('post')) {
            $employeeForm = $this->request->getData();
        } else {
            $employeeForm = [
                'gender' => 1,
                'dept_id' => 1,
                'authority' => 1,
            ];
        }

        $this->set(compact('employeeForm'));

        return null;
    }

    public function check(): ?Response
    {
        $this->request->allowMethod(['post']);
        $this->viewBuilder()->disableAutoLayout();
        $this->viewBuilder()->setTemplate('check');

        $employeeForm = $this->request->getData();
        $errors = $this->validateEmployeeForm($employeeForm);

        if ($errors !== []) {
            $this->set(compact('employeeForm', 'errors'));

            return $this->render('input');
        }

        $this->request->getSession()->write(self::SESSION_FORM_KEY, $employeeForm);
        $this->setLabelAttributes($employeeForm);
        $this->set('loginUser', $this->getLoginUser());
        $this->set(compact('employeeForm'));

        return null;
    }

    public function complete(): Response
    {
        $this->request->allowMethod(['post']);

        $employeeForm = $this->request->getData();
        $errors = $this->validateEmployeeForm($employeeForm);
        if ($errors !== []) {
            return $this->redirect('/regist_input');
        }

        $data = $this->prepareSaveData($employeeForm);
        $employee = $this->Employees->newEntity($data);
        if (!$this->Employees->save($employee)) {
            return $this->redirect('/regist_input');
        }

        $this->request->getSession()->delete(self::SESSION_FORM_KEY);

        return $this->redirect('/regist_complete');
    }

    public function completeView(): ?Response
    {
        $this->viewBuilder()->disableAutoLayout();
        $this->viewBuilder()->setTemplate('complete');
        $this->set('loginUser', $this->getLoginUser());

        return null;
    }

    /**
     * @param array<string, mixed> $employeeForm
     * @return array<string, string>
     */
    private function validateEmployeeForm(array $employeeForm): array
    {
        $entity = $this->Employees->newEntity($employeeForm);
        $errors = $entity->getErrors();
        foreach (EmployeeRegistService::validateBirthdayField($employeeForm) as $field => $message) {
            $errors[$field][] = $message;
        }

        $flat = [];
        foreach ($errors as $field => $messages) {
            $flat[$field] = is_array($messages) ? (string)reset($messages) : (string)$messages;
        }

        return $flat;
    }

    /**
     * @param array<string, mixed> $employeeForm
     * @return array<string, mixed>
     */
    private function prepareSaveData(array $employeeForm): array
    {
        $data = $employeeForm;
        $birthday = EmployeeRegistService::parseBirthday((string)($data['birthday'] ?? ''));
        if ($birthday !== null) {
            $data['birthday'] = $birthday->format('Y-m-d');
        }
        unset($data['emp_id']);

        return $data;
    }

    /**
     * @param array<string, mixed> $employeeForm
     */
    private function setLabelAttributes(array $employeeForm): void
    {
        $gender = isset($employeeForm['gender']) ? (int)$employeeForm['gender'] : null;
        $authority = isset($employeeForm['authority']) ? (int)$employeeForm['authority'] : null;
        $deptId = isset($employeeForm['dept_id']) ? (int)$employeeForm['dept_id'] : null;

        $this->set([
            'genderLabel' => EmployeeRegistService::genderLabel($gender),
            'authorityLabel' => EmployeeRegistService::authorityLabel($authority),
            'deptName' => EmployeeRegistService::deptName($deptId),
        ]);
    }
}
