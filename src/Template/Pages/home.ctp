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

$cakeDescription = 'Mi Retador | Home';
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
            <?= $this->Html->css(['bootstrap', 'style']) ?>
            <?= $this->Html->script([ 'jquery-3.2.1.min', 'bootstrap', 'bootstrap-filestyle.min', 'https://use.fontawesome.com/0394caa6cc.js']) ?>
            
    </head>
    <body>
        
        <nav class="navbar navbar-default ´navbarHome">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">
                        <?= $this->Html->image('cake.logo.svg', ['alt' => 'Mi Retador logo', 'class' => 'img-responsive img-thumbnail']) ?>
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                        <?= $this->Html->link('Iniciar Sesión', ['controller' => 'Users', 'action' => 'login' ], ['class' => 'btn btn-sm btn-success']) ?>
                </ul>
            </div>
        </nav>
        
        
    </body>
    </html>