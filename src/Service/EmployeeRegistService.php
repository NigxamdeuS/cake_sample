<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Entity\Employee;
use Cake\I18n\Date;
use Cake\Validation\Validator;

class EmployeeRegistService
{
    public const BIRTHDAY_FORMAT = 'yyyy/MM/dd';

    public static function genderLabel(?int $gender): string
    {
        if ($gender === null) {
            return '';
        }

        return $gender === 1 ? '男性' : '女性';
    }

    public static function authorityLabel(?int $authority): string
    {
        if ($authority === null) {
            return '';
        }

        return $authority === 1 ? '一般' : '管理者';
    }

    public static function deptName(?int $deptId): string
    {
        return match ($deptId) {
            1 => '営業部',
            2 => '経理部',
            3 => '総務部',
            default => '',
        };
    }

    public static function formatBirthday(Date $birthday): string
    {
        return $birthday->i18nFormat(self::BIRTHDAY_FORMAT);
    }

    public static function parseBirthday(string $birthday): ?Date
    {
        $trimmed = trim($birthday);
        if ($trimmed === '') {
            return null;
        }

        try {
            $parsed = Date::createFromFormat('Y/m/d', $trimmed);
            if ($parsed === false) {
                return null;
            }

            return $parsed;
        } catch (\Exception) {
            return null;
        }
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, string>
     */
    public static function validateBirthdayField(array $data): array
    {
        $errors = [];
        $birthday = $data['birthday'] ?? '';
        if (is_string($birthday) && trim($birthday) !== '' && self::parseBirthday($birthday) === null) {
            $errors['birthday'] = '生年月日は YYYY/MM/DD 形式で入力してください。';
        }

        return $errors;
    }

    public static function employeeToFormData(Employee $employee): array
    {
        return [
            'emp_id' => $employee->emp_id,
            'emp_pass' => $employee->emp_pass,
            'emp_name' => $employee->emp_name,
            'gender' => $employee->gender,
            'address' => $employee->address,
            'birthday' => self::formatBirthday($employee->birthday),
            'authority' => $employee->authority,
            'dept_id' => $employee->dept_id,
        ];
    }
}
