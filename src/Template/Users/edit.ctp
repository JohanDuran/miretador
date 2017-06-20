<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?= $this->Html->css('sesion') ?>

<div class="container">
    

    <div class="col-md-10 col-md-offset-1 main" >
        <div class="col-md-6 left-side" >
            <h3>MIRETADOR.COM</h3>
            <p>Editar la información de <?= $user->name ?>.</p>
            <br>
        
        
        </div><!--col-sm-6-->
    
        <div class="col-md-6 right-side">
            <?= $this->Form->create($user, ['novalidate', 'type' => 'file']) ?>
            <h3>Editar perfil</h3>
            
            <!--Form with header-->
            <div class="form">
            
            
                <div class="form-group">
                    <?= $this->Form->input('email', ['class' => 'form-control input-lg', 'placeholder' => 'Correo electrónico', 'label' => false, 'readonly']) ?>
                </div>
                
                <div class="form-group">
                   <?= $this->Form->input('password', ['class' => 'form-control input-lg', 'placeholder' => 'Contraseña', 'label' => false, 'value' => '']) ?>
                </div>
                
                <div class="form-group">
                    <?= $this->Form->input('name', ['class' => 'form-control input-lg', 'placeholder' => 'Nombre', 'label' => false]) ?>
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
                    <?= $this->Form->button('Editar', ['class' => 'btn btn-deep btn-blue']) ?>
                </div>
            
            </div>
            <!--/Form with header-->
        
        <?= $this->Form->end() ?>
        </div><!--col-sm-6-->
    
    </div><!--col-sm-8-->

</div><!--container-->