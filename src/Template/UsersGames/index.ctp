<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users Game'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fields'), ['controller' => 'Fields', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Field'), ['controller' => 'Fields', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersGames index large-9 medium-8 columns content">
    <h3><?= __('Users Games') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('field_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('meet') ?></th>
                <th scope="col"><?= $this->Paginator->sort('challenged') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersGames as $usersGame): ?>
            <tr>
                <td><?= $this->Number->format($usersGame->id) ?></td>
                <td><?= $usersGame->has('user') ? $this->Html->link($usersGame->user->name, ['controller' => 'Users', 'action' => 'view', $usersGame->user->id]) : '' ?></td>
                <td><?= $usersGame->has('field') ? $this->Html->link($usersGame->field->name, ['controller' => 'Fields', 'action' => 'view', $usersGame->field->id]) : '' ?></td>
                <td><?= h($usersGame->meet) ?></td>
                <td><?= $this->Number->format($usersGame->challenged) ?></td>
                <td><?= h($usersGame->state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usersGame->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersGame->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersGame->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersGame->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
