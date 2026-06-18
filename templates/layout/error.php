<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?= $this->Html->charset() ?>
    <title><?= h($this->fetch('title')) ?></title>
    <?= $this->Html->css('layout') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="page-login">
    <main class="login-main">
        <div class="login-card">
            <?= $this->fetch('content') ?>
            <p><?= $this->Html->link('戻る', 'javascript:history.back()') ?></p>
        </div>
    </main>
</body>
</html>
