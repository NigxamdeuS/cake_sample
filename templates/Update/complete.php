<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $loginUser
 */
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
            <h3 class="title">社員更新完了画面</h3>
            <div class="message">
                <p class="complete_message">社員更新処理が完了しました。</p>
                <p class="complete_link"><?= $this->Html->link('一覧表示に戻る', '/list') ?></p>
            </div>
        </article>
    </div>
    <?= $this->element('employee_particles_scripts') ?>
</body>
</html>
