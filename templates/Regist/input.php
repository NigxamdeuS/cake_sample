<?php
/**
 * @var \App\View\AppView $this
 * @var array<string, mixed> $employeeForm
 * @var array<string, string>|null $errors
 */

$errors = $errors ?? [];
$val = static function (array $form, string $key, mixed $default = '') use (&$val): string {
    return isset($form[$key]) ? (string)$form[$key] : (string)$default;
};
$gender = (int)$val($employeeForm, 'gender', '1');
$authority = (int)$val($employeeForm, 'authority', '1');
$deptId = (int)$val($employeeForm, 'dept_id', '1');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->element('employee_assets') ?>
    <title>社員管理システム</title>
</head>
<body>
    <?= $this->element('employee_particles') ?>
    <?= $this->element('employee_header', ['loginUser' => null]) ?>
    <div class="content">
        <article class="form-article">
            <h3>社員登録入力画面</h3>
            <div class="update">
                <?= $this->Form->create(null, ['url' => '/regist_check']) ?>
                    <div class="form">
                        <div class="label">パスワード：</div>
                        <div class="input">
                            <input type="password" name="emp_pass" value="<?= h($val($employeeForm, 'emp_pass')) ?>" />
                            <?php if (!empty($errors['emp_pass'])) : ?>
                                <p class="form-error"><?= h($errors['emp_pass']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form">
                        <div class="label">社員名：</div>
                        <div class="input">
                            <input type="text" name="emp_name" value="<?= h($val($employeeForm, 'emp_name')) ?>" />
                            <?php if (!empty($errors['emp_name'])) : ?>
                                <p class="form-error"><?= h($errors['emp_name']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form">
                        <div class="label">性別：</div>
                        <div class="input">
                            <input type="radio" name="gender" value="1" id="gender1" <?= $gender === 1 ? 'checked' : '' ?> />男性&nbsp;
                            <input type="radio" name="gender" value="2" id="gender2" <?= $gender === 2 ? 'checked' : '' ?> />女性
                        </div>
                    </div>
                    <div class="form">
                        <div class="label">住所：</div>
                        <div class="input">
                            <input type="text" name="address" value="<?= h($val($employeeForm, 'address')) ?>" />
                            <?php if (!empty($errors['address'])) : ?>
                                <p class="form-error"><?= h($errors['address']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form">
                        <div class="label">生年月日：</div>
                        <div class="input">
                            <input type="text" name="birthday" value="<?= h($val($employeeForm, 'birthday')) ?>" /> (YYYY/MM/DD)
                            <?php if (!empty($errors['birthday'])) : ?>
                                <p class="form-error"><?= h($errors['birthday']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form">
                        <div class="label">権限：</div>
                        <div class="input">
                            <input type="radio" name="authority" value="1" id="authority1" <?= $authority === 1 ? 'checked' : '' ?> />一般&nbsp;&nbsp;
                            <input type="radio" name="authority" value="2" id="authority2" <?= $authority === 2 ? 'checked' : '' ?> />管理者
                        </div>
                    </div>
                    <div class="form">
                        <div class="label">部署名：</div>
                        <div class="input">
                            <select name="dept_id">
                                <option value="1" <?= $deptId === 1 ? 'selected' : '' ?>>営業部</option>
                                <option value="2" <?= $deptId === 2 ? 'selected' : '' ?>>経理部</option>
                                <option value="3" <?= $deptId === 3 ? 'selected' : '' ?>>総務部</option>
                            </select>
                            <?php if (!empty($errors['dept_id'])) : ?>
                                <p class="form-error"><?= h($errors['dept_id']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form btn-row">
                        <div class="label is-empty"></div>
                        <div class="input">
                            <input type="submit" value="登録" />
                        </div>
                    </div>
                <?= $this->Form->end() ?>
                <?= $this->Form->create(null, ['url' => '/', 'type' => 'get']) ?>
                    <div class="form btn-row">
                        <div class="label is-empty"></div>
                        <div class="input">
                            <input type="submit" value="戻る" />
                        </div>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </article>
    </div>
    <?= $this->element('employee_particles_scripts') ?>
</body>
</html>
