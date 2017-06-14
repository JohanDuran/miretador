<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Field'), ['action' => 'edit', $usersField->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Field'), ['action' => 'delete', $usersField->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersField->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Fields'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Field'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fields'), ['controller' => 'Fields', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Field'), ['controller' => 'Fields', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersFields view large-9 medium-8 columns content">
    <h3><?= h($usersField->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $usersField->has('user') ? $this->Html->link($usersField->user->name, ['controller' => 'Users', 'action' => 'view', $usersField->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Field') ?></th>
            <td><?= $usersField->has('field') ? $this->Html->link($usersField->field->name, ['controller' => 'Fields', 'action' => 'view', $usersField->field->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersField->id) ?></td>
        </tr>
    </table>
</div>
