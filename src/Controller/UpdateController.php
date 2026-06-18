<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Employee;
use App\Service\EmployeeRegistService;
use Cake\Http\Response;

/**
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class UpdateController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Employees = $this->fetchTable('Employees');
    }

    public function input(): ?Response
    {
        $loginUser = $this->getLoginUser();
        if ($loginUser === null) {
            return $this->redirect('/');
        }

        $employee = $this->Employees->get($loginUser->emp_id);
        $empUpdateForm = EmployeeRegistService::employeeToFormData($employee);

        $this->viewBuilder()->disableAutoLayout();
        $this->viewBuilder()->setTemplate('input');
        $this->set(compact('loginUser', 'empUpdateForm'));

        return null;
    }

    public function check(): ?Response
    {
        $this->request->allowMethod(['post']);
        $this->viewBuilder()->disableAutoLayout();
        $this->viewBuilder()->setTemplate('check');

        $loginUser = $this->getLoginUser();
        if ($loginUser === null) {
            return $this->redirect('/');
        }

        $empUpdateForm = $this->request->getData();
        $empId = isset($empUpdateForm['emp_id']) ? (int)$empUpdateForm['emp_id'] : 0;
        if ($empId !== $loginUser->emp_id) {
            return $this->redirect('/list');
        }

        $errors = $this->validateUpdateForm($empUpdateForm);
        if ($errors !== []) {
            $this->set(compact('loginUser', 'empUpdateForm', 'errors'));

            return $this->render('input');
        }

        $this->setLabelAttributes($empUpdateForm);
        $this->set(compact('loginUser', 'empUpdateForm'));

        return null;
    }

    public function complete(): Response
    {
        $this->request->allowMethod(['post']);

        $loginUser = $this->getLoginUser();
        if ($loginUser === null) {
            return $this->redirect('/');
        }

        $empUpdateForm = $this->request->getData();
        $empId = isset($empUpdateForm['emp_id']) ? (int)$empUpdateForm['emp_id'] : 0;
        if ($empId !== $loginUser->emp_id) {
            return $this->redirect('/list');
        }

        $data = $this->prepareSaveData($empUpdateForm);
        $employee = $this->Employees->get($empId);
        $employee = $this->Employees->patchEntity($employee, $data);
        if (!$this->Employees->save($employee)) {
            return $this->redirect('/update_input');
        }

        $updated = $this->Employees->get($empId);
        $this->request->getSession()->write('loginUser', $updated);

        return $this->redirect('/update_complete');
    }

    public function completeView(): ?Response
    {
        $loginUser = $this->getLoginUser();
        if ($loginUser === null) {
            return $this->redirect('/');
        }

        $this->viewBuilder()->disableAutoLayout();
        $this->viewBuilder()->setTemplate('complete');
        $this->set(compact('loginUser'));

        return null;
    }

    /**
     * @param array<string, mixed> $empUpdateForm
     * @return array<string, string>
     */
    private function validateUpdateForm(array $empUpdateForm): array
    {
        $entity = $this->Employees->newEntity($empUpdateForm);
        $errors = $entity->getErrors();
        foreach (EmployeeRegistService::validateBirthdayField($empUpdateForm) as $field => $message) {
            $errors[$field][] = $message;
        }

        $flat = [];
        foreach ($errors as $field => $messages) {
            $flat[$field] = is_array($messages) ? (string)reset($messages) : (string)$messages;
        }

        return $flat;
    }

    /**
     * @param array<string, mixed> $empUpdateForm
     * @return array<string, mixed>
     */
    private function prepareSaveData(array $empUpdateForm): array
    {
        $data = $empUpdateForm;
        $birthday = EmployeeRegistService::parseBirthday((string)($data['birthday'] ?? ''));
        if ($birthday !== null) {
            $data['birthday'] = $birthday->format('Y-m-d');
        }

        return $data;
    }

    /**
     * @param array<string, mixed> $empUpdateForm
     */
    private function setLabelAttributes(array $empUpdateForm): void
    {
        $gender = isset($empUpdateForm['gender']) ? (int)$empUpdateForm['gender'] : null;
        $authority = isset($empUpdateForm['authority']) ? (int)$empUpdateForm['authority'] : null;
        $deptId = isset($empUpdateForm['dept_id']) ? (int)$empUpdateForm['dept_id'] : null;

        $this->set([
            'genderLabel' => EmployeeRegistService::genderLabel($gender),
            'authorityLabel' => EmployeeRegistService::authorityLabel($authority),
            'deptName' => EmployeeRegistService::deptName($deptId),
        ]);
    }
}
