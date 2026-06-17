<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $loginUser
 * @var array<string, mixed> $empUpdateForm
 * @var array<string, string>|null $errors
 */

$errors = $errors ?? [];
$val = static function (array $form, string $key): string {
    return isset($form[$key]) ? (string)$form[$key] : '';
};
$gender = (int)$val($empUpdateForm, 'gender');
$authority = (int)$val($empUpdateForm, 'authority');
$deptId = (int)$val($empUpdateForm, 'dept_id');
if ($gender === 0) {
    $gender = 1;
}
if ($authority === 0) {
    $authority = 1;
}
if ($deptId === 0) {
    $deptId = 1;
}
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
    <?= $this->element('employee_header', ['loginUser' => $loginUser]) ?>
    <div class="content">
        <article>
            <h3>社員更新入力画面</h3>
            <div class="update">
                <?= $this->Form->create(null, ['url' => '/update_check']) ?>
                    <div class="form">
                        <div class="label">社員ID：</div>
                        <div class="input">
                            <input type="text" name="emp_id" value="<?= h($val($empUpdateForm, 'emp_id')) ?>" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form">
                        <div class="label">パスワード：</div>
                        <div class="input">
                            <input type="password" name="emp_pass" value="<?= h($val($empUpdateForm, 'emp_pass')) ?>" />
                            <?php if (!empty($errors['emp_pass'])) : ?>
                                <p class="form-error"><?= h($errors['emp_pass']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form">
                        <div class="label">社員名：</div>
                        <div class="input">
                            <input type="text" name="emp_name" value="<?= h($val($empUpdateForm, 'emp_name')) ?>" />
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
                            <input type="text" name="address" value="<?= h($val($empUpdateForm, 'address')) ?>" />
                            <?php if (!empty($errors['address'])) : ?>
                                <p class="form-error"><?= h($errors['address']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form">
                        <div class="label">生年月日：</div>
                        <div class="input">
                            <input type="text" name="birthday" value="<?= h($val($empUpdateForm, 'birthday')) ?>" /> (YYYY/MM/DD)
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
                        </div>
                    </div>
                    <div class="form">
                        <div class="label"></div>
                        <div class="input">
                            <input type="submit" value="更新" />
                        </div>
                    </div>
                <?= $this->Form->end() ?>
                <?= $this->Form->create(null, ['url' => '/list', 'type' => 'get']) ?>
                    <div class="form">
                        <div class="label"></div>
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
