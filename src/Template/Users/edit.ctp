<?php
/**
 * Mi Retador : Página creada por Kenneth Calvo y Johan Durán para el curso de desarrollo de aplicaciones web, impartido por el profesor Braulio Solano en la Universidad de Costa Rica.
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
$this->layout = false;

$name = explode(" ", $user->name);
$cakeDescription = 'Mi Retador | Editar ' . $name[0];
?>

<!DOCTYPE html>
    <html>

    <head>
        <?= $this->Html->charset() ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>
                <?= $cakeDescription ?>
            </title>
            <?= $this->Html->meta('icon') ?>
            <?= $this->Html->css(['bootstrap', 'style', 'sesion']) ?>
            <?= $this->Html->script([ 'jquery-3.2.1.min', 'bootstrap', 'bootstrap-filestyle.min', 'https://use.fontawesome.com/0394caa6cc.js', 'home']) ?>
            
    </head>
    <body>

<div class="container">
    

    <div class="col-md-10 col-md-offset-1 main" >
        <div class="col-md-6 left-side" >
            <?= $this->Html->image('logo.svg', ['alt' => 'Logo Mi Retador', 'class' => 'img-responsive  center-block logo', 'url' => ['controller' => 'Pages', 'action' => 'display', 'home']]) ?>
            
            <h3 class="center-block"><?= $this->Html->link('Mi Retador', ['controller' => 'Pages', 'action' => 'display', 'home' ])?></h3>
            <p class="center-block">Editar la información de <?= $user->name ?>.</p>
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
            <div class="text-xs-center">
                <?= $this->Form->postLink('Eliminar el usuario', ['action' => 'delete', $user->id], ['confirm' => '¿Seguro que desea eliminar el usuario?', 'class' => 'delete']) ?>
            </div>
        </div><!--col-sm-6-->
    
    </div><!--col-sm-8-->

</div><!--container-->


    </body>
    </html>