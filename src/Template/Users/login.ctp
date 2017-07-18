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



$cakeDescription = 'Mi Retador | Login';
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
            <p class="center-block">Conectarse a MIRETADOR.COM</p>
            <br>
        
        
        </div><!--col-sm-6-->
    
        <div class="col-md-6 right-side">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create() ?>
            <h3>Iniciar Sesión</h3>
            
            <!--Form with header-->
            <div class="form">
            
                <?php
                    $state['state']=isset($state['state'])?$state['state']:-1;
                    echo $this->Form->hidden('lastPage', ['value'=>$state['state']])
                ?>

                <div class="form-group">
                    
                    <?= $this->Form->input('email', ['class' => 'form-control input-lg', 'placeholder' => 'Correo electrónico', 'label' => false, 'required']) ?>
                    
                </div>
                
                <div class="form-group">
                    <?= $this->Form->input('password', ['class' => 'form-control input-lg', 'placeholder' => 'Contraseña', 'label' => false, 'required']) ?>
                   
                </div>
                
                <div class="row botones">
                    <div class="col-xs-6 col-sm-offset-6 col-sm-3 col-md-offset-1 col-md-6 col-lg-offset-4 col-lg-4">
                        <?= $this->Html->link('Registrarse', ['controller' => 'Users', 'action' => 'add' ], ['class' => 'btn btn-deep btn-blue']) ?>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-5 col-lg-4">
                        <?= $this->Form->submit('Ingresar' ,['class' => 'btn btn-deep btn-green' ]) ?>
                    </div>
                    
                    
                    
                </div>
            
            </div>
            <!--/Form with header-->
        <?= $this->Form->end() ?>
        
        <div class="text-xs-center facebook">
            <div class="divider">
                O también puedes...
            </div>
            
            <?= $this->Form->postLink(
                ' Iniciar con Facebook',
                ['controller' => 'Users', 'action' => 'login', '?' => ['provider' => 'Facebook']], ['class' => 'fa fa-facebook-official btn btn-deep btn-facebook']
            ); ?>
        </div>
        
        </div><!--col-sm-6-->
    
    </div><!--col-sm-8-->

</div><!--container-->

    </body>
    </html>