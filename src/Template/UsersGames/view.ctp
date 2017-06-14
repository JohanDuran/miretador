<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Game'), ['action' => 'edit', $usersGame->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Game'), ['action' => 'delete', $usersGame->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersGame->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Games'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Game'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fields'), ['controller' => 'Fields', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Field'), ['controller' => 'Fields', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersGames view large-9 medium-8 columns content">
    <h3><?= h($usersGame->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $usersGame->has('user') ? $this->Html->link($usersGame->user->name, ['controller' => 'Users', 'action' => 'view', $usersGame->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Field') ?></th>
            <td><?= $usersGame->has('field') ? $this->Html->link($usersGame->field->name, ['controller' => 'Fields', 'action' => 'view', $usersGame->field->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersGame->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Challenged') ?></th>
            <td><?= $this->Number->format($usersGame->challenged) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meet') ?></th>
            <td><?= h($usersGame->meet) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $usersGame->state ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
