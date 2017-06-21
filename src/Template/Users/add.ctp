<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php /*
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users Games'), ['controller' => 'UsersGames', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Users Game'), ['controller' => 'UsersGames', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fields'), ['controller' => 'Fields', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Field'), ['controller' => 'Fields', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('name');
            echo $this->Form->input('phone');
            echo $this->Form->input('owner');
            echo $this->Form->input('description');
            echo $this->Form->input('photo', ['type' => 'file', 'class' => 'filestyle', 'data-buttonName' => 'btn-primary', 'data-buttonText' => 'Examinar', 'data-placeholder'=>"Aún no se ha selecionado una imagen", 'data-iconName'=>' fa fa-file-image-o']);
            echo $this->Form->input('fields._ids', ['options' => $fields]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
*/
?>

<?= $this->Html->css('sesion') ?>

<div class="container">
    

    <div class="col-md-10 col-md-offset-1 main" >
        <div class="col-md-6 left-side" >
            <?= $this->Html->image('logo.svg', ['alt' => 'Logo Mi Retador', 'class' => 'img-responsive  center-block logo', 'url' => ['controller' => 'Pages', 'action' => 'display', 'home']]) ?>
            
            <h3 class="center-block"><?= $this->Html->link('Mi Retador', ['controller' => 'Pages', 'action' => 'display', 'home' ])?></h3>
            <p class="center-block">Bienvenido a MIRETADOR.COM</p>
            <br>
        
        
        </div><!--col-sm-6-->
    
        <div class="col-md-6 right-side">
            <?= $this->Form->create($user, ['type' => 'file']) ?>
            <h3>Registrarse</h3>
            
            <!--Form with header-->
            <div class="form">
            
            
                <div class="form-group">
                    <?= $this->Form->input('email', ['class' => 'form-control input-lg', 'placeholder' => 'Correo electrónico', 'label' => false, 'required']) ?>
                </div>
                
                <div class="form-group">
                   <?= $this->Form->input('password', ['class' => 'form-control input-lg', 'placeholder' => 'Contraseña', 'label' => false, 'required']) ?>
                </div>
                
                <div class="form-group">
                    <?= $this->Form->input('name', ['class' => 'form-control input-lg', 'placeholder' => 'Nombre', 'label' => false, 'required']) ?>
                </div>
                
                <div class="form-group">
                    <?= $this->Form->input('phone', ['class' => 'form-control input-lg', 'placeholder' => 'Número de teléfono', 'label' => false]) ?>
                </div>
                
                <div class="form-group">
                    <?= $this->Form->input('description', ['class' => 'form-control input-lg', 'placeholder' => 'Información sobre ti', 'label' => false]) ?>
                </div>
                
                <div class="form-group">
                   <?= $this->Form->input('photo', ['type' => 'file', 'class' => 'filestyle form-control input-lg', 'data-buttonName' => 'btn btn-image btn-blue', 'data-buttonText' => 'Examinar', 'data-placeholder'=>"Aún no se ha selecionado una imagen", 'data-iconName'=>' fa fa-file-image-o' , 'label' => false]) ?>
                </div>
                
                <div class="text-xs-center">
                    <?= $this->Form->button('Registrarse', ['class' => 'btn btn-deep btn-blue']) ?>
                </div>
            
            </div>
            <!--/Form with header-->
        
        <?= $this->Form->end() ?>
        </div><!--col-sm-6-->
    
    </div><!--col-sm-8-->

</div><!--container-->