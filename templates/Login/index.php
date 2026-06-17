<?php
/**
 * @var \App\View\AppView $this
 * @var string $empId
 * @var string|null $errorMessage
 */
$empId = $empId ?? '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->element('employee_assets') ?>
    <title>社員管理システム</title>
</head>
<body class="page-login">
    <?= $this->element('employee_particles') ?>
    <header class="site-header login-header">
        <div class="site-header-inner login-header-inner">
            <div class="site-brand login-brand">Partner</div>
            <?= $this->Html->link('新規社員登録', '/regist_input', ['class' => 'login-header-link']) ?>
        </div>
    </header>

    <main class="login-main">
        <div class="login-card">
            <h1 class="login-card-title">社員管理システムログイン</h1>

            <?php if (!empty($errorMessage)) : ?>
                <p class="login-error">
                    <span><?= h($errorMessage) ?></span>
                </p>
            <?php endif; ?>

            <?= $this->Form->create(null, [
                'url' => '/login',
                'type' => 'get',
                'class' => 'login-card-form',
            ]) ?>
                <div class="login-field">
                    <label class="login-field-label" for="empId">社員ID</label>
                    <input class="login-field-input" type="text" id="empId" name="empId" value="<?= h($empId) ?>" autocomplete="username">
                </div>

                <div class="login-field">
                    <label class="login-field-label" for="empPass">パスワード</label>
                    <input class="login-field-input" type="password" id="empPass" name="empPass" autocomplete="current-password">
                </div>

                <button class="login-submit" type="submit">ログイン</button>
            <?= $this->Form->end() ?>
        </div>
    </main>
    <?= $this->element('employee_particles_scripts') ?>
</body>
</html>
