<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $loginUser
 * @var array<int, \App\Model\Entity\Employee> $employeeList
 * @var string $empName
 * @var bool $noResult
 */

use App\Service\EmployeeRegistService;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->element('employee_assets') ?>
    <style>
        table.list_table th.delete,
        table.list_table td.delete {
            width: 96px;
            min-width: 96px;
            box-sizing: border-box;
            text-align: center;
            vertical-align: middle;
            padding: 8px 6px;
        }

        table.list_table button.btn-delete {
            display: inline-block;
            margin: 0;
            padding: 0.45em 0.9em;
            font-family: inherit;
            font-size: 0.8125rem;
            font-weight: 700;
            line-height: 1.3;
            color: #ffffff;
            background-color: #e05656;
            border: none;
            border-radius: 4px;
            border-bottom: solid 4px #b84545;
            box-sizing: border-box;
            white-space: nowrap;
            cursor: default;
            -webkit-appearance: none;
            appearance: none;
        }

        table.list_table button.btn-delete:active {
            transform: translateY(4px);
            border-bottom: solid 4px transparent;
        }
    </style>
    <title>社員管理システム</title>
</head>
<body>
    <?= $this->element('employee_particles') ?>
    <?= $this->element('employee_header', ['loginUser' => $loginUser]) ?>
    <div class="content">
        <aside class="search">
            <div class="title">社員名検索</div>
            <div class="form">
                <?= $this->Form->create(null, ['url' => '/list', 'type' => 'get']) ?>
                    <input type="text" name="empName" value="<?= h($empName) ?>" />
                    <input type="submit" value="検索" />
                <?= $this->Form->end() ?>
            </div>
        </aside>
        <div class="content">
            <article>
                <h3>社員一覧画面</h3>

                <?php if ($noResult) : ?>
                    <div class="message">
                        <p class="back_to_top_message">該当する社員は存在しません。</p>
                        <p class="back_to_top_link">
                            <?= $this->Html->link('一覧表示に戻る', '/list') ?>
                        </p>
                    </div>
                <?php else : ?>
                    <table class="list_table">
                        <tr>
                            <th class="empId">社員ID</th>
                            <th class="empName">社員名</th>
                            <th class="gender">性別</th>
                            <th class="address">住所</th>
                            <th class="birthday">生年月日</th>
                            <th class="authority">権限</th>
                            <th class="deptName">部署名</th>
                            <th class="delete">削除</th>
                        </tr>
                        <?php foreach ($employeeList as $emp) : ?>
                            <?php
                            $deptName = $emp->department->dept_name ?? EmployeeRegistService::deptName($emp->dept_id);
                            ?>
                            <tr>
                                <td><?= h($emp->emp_id) ?></td>
                                <td><?= h($emp->emp_name) ?></td>
                                <td><span><?= h(EmployeeRegistService::genderLabel($emp->gender)) ?></span></td>
                                <td><?= h($emp->address) ?></td>
                                <td><?= h(EmployeeRegistService::formatBirthday($emp->birthday)) ?></td>
                                <td><span><?= h(EmployeeRegistService::authorityLabel($emp->authority)) ?></span></td>
                                <td><?= h($deptName) ?></td>
                                <td class="delete">
                                    <?= $this->Form->create(null, ['url' => '/delete', 'class' => 'delete-form']) ?>
                                        <input type="hidden" name="empId" value="<?= h($emp->emp_id) ?>">
                                        <button type="submit" class="btn-delete">削除</button>
                                    <?= $this->Form->end() ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </article>
        </div>
    </div>
    <?= $this->element('employee_particles_scripts') ?>
</body>
</html>
