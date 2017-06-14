<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $field->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $field->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fields'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users Games'), ['controller' => 'UsersGames', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Users Game'), ['controller' => 'UsersGames', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fields form large-9 medium-8 columns content">
    <?= $this->Form->create($field, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit Field') ?></legend>
        <?php
            echo $this->Form->input('user_id');
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('latitude');
            echo $this->Form->input('longitude');
            echo $this->Form->input('price');
            echo $this->Form->input('contact');
            echo $this->Form->input('start');
            echo $this->Form->input('finish');
            echo $this->Form->input('photo', ['type' => 'file', 'class' => 'filestyle', 'data-buttonName' => 'btn-primary', 'data-buttonText' => 'Examinar', 'data-placeholder'=>"Aún no se ha selecionado una imagen", 'data-iconName'=>' fa fa-file-image-o']);
            echo $this->Form->input('users._ids', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
