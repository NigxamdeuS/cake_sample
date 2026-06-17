<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee|null $loginUser
 */
?>
<header class="site-header">
    <div class="content">
        <div class="title">Partner</div>
        <?php if ($loginUser !== null) : ?>
            <div class="user_info site-header-nav">
                ようこそ、<?= $this->Html->link(h($loginUser->emp_name), '/update_input') ?>さん
                <span class="pipeline">|</span><?= $this->Html->link('ログアウト', '/logout') ?>
            </div>
        <?php endif; ?>
    </div>
</header>
