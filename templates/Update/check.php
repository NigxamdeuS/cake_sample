<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $loginUser
 * @var array<string, mixed> $empUpdateForm
 * @var string $genderLabel
 * @var string $authorityLabel
 * @var string $deptName
 */
$hidden = static function (array $form, string $name) {
    $value = $form[$name] ?? '';

    return sprintf('<input type="hidden" name="%s" value="%s">', h($name), h((string)$value));
};
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
            <h3>社員更新確認画面</h3>
            <div class="update">
                <div class="form">
                    <div class="label">社員ID：</div>
                    <div class="input"><?= h($empUpdateForm['emp_id'] ?? '') ?></div>
                </div>
                <div class="form">
                    <div class="label">パスワード：</div>
                    <div class="input">※非表示</div>
                </div>
                <div class="form">
                    <div class="label">社員名：</div>
                    <div class="input"><?= h($empUpdateForm['emp_name'] ?? '') ?></div>
                </div>
                <div class="form">
                    <div class="label">性別：</div>
                    <div class="input"><span><?= h($genderLabel) ?></span></div>
                </div>
                <div class="form">
                    <div class="label">住所：</div>
                    <div class="input"><?= h($empUpdateForm['address'] ?? '') ?></div>
                </div>
                <div class="form">
                    <div class="label">生年月日：</div>
                    <div class="input"><?= h($empUpdateForm['birthday'] ?? '') ?></div>
                </div>
                <div class="form">
                    <div class="label">権限：</div>
                    <div class="input"><span><?= h($authorityLabel) ?></span></div>
                </div>
                <div class="form">
                    <div class="label">部署名：</div>
                    <div class="input"><?= h($deptName) ?></div>
                </div>
                <?= $this->Form->create(null, ['url' => '/update_complete']) ?>
                    <div class="form">
                        <div class="label"></div>
                        <div class="input">
                            <?= $hidden($empUpdateForm, 'emp_id') ?>
                            <?= $hidden($empUpdateForm, 'emp_pass') ?>
                            <?= $hidden($empUpdateForm, 'emp_name') ?>
                            <?= $hidden($empUpdateForm, 'gender') ?>
                            <?= $hidden($empUpdateForm, 'address') ?>
                            <?= $hidden($empUpdateForm, 'birthday') ?>
                            <?= $hidden($empUpdateForm, 'authority') ?>
                            <?= $hidden($empUpdateForm, 'dept_id') ?>
                            <input type="submit" value="更新" />
                        </div>
                    </div>
                <?= $this->Form->end() ?>
                <?= $this->Form->create(null, ['url' => '/update_input', 'type' => 'get']) ?>
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
