<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Mi Retador | ';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['bootstrap', 'style']) ?>
    <?= $this->Html->script([ 'jquery-3.2.1.min', 'bootstrap', 'bootstrap-filestyle.min', 'https://use.fontawesome.com/0394caa6cc.js', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!-- NAV -->
    
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?= $this->Html->image('logo.svg', ['alt' => 'Logo Mi Retador', 'class' => 'navbar-brand img-responsive logo_menu', 'url' => ['controller' => 'Pages', 'action' => 'display', 'home']]) ?>
                <?= $this->Html->link('Mi Retador', ['controller' => 'Pages', 'action' => 'display', 'home' ], ['class' => 'brand_name navbar-brand']) ?> 
        
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php if(isset($current_user)): ?>
                <?php if($current_user['role'] == 'admin'): ?>
                <ul class="nav navbar-nav">
                    
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrador  <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link('Usuarios', ['controller' => 'Users', 'action' => 'index', $current_user['id'] ]) ?></li>
                    </ul>
                    </li>
                
                </ul>
                <?php endif; ?>
                <ul class="nav navbar-nav navbar-right">
                
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user icon-fa" aria-hidden="true"></i> Hola, <?= h($current_user['name']); ?>  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link('Mi perfil', ['controller' => 'Users', 'action' => 'view', $current_user['id'] ]) ?></li>
                            <li role="separator" class="divider"></li>
                            <li><?= $this->Html->link('Editar perfil', ['controller' => 'Users', 'action' => 'edit', $current_user['id'] ]) ?></li>
                            <li><?= $this->Html->link('Cerrar sesión', ['controller' => 'Users', 'action' => 'logout' ], ['class' => '']) ?></li>
                        </ul>
                    </li>
                
                </ul>
                <?php else: ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><?= $this->Html->link('Iniciar sesión', ['controller' => 'Users', 'action' => 'login' ], ['class' => 'login-button']) ?></li>
                    </ul>
                <?php endif; ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    
    
    <?= $this->Flash->render() ?>
    <div class="container">
        <?= $this->fetch('content') ?>
    </div>
    
    <?php //var_dump($current_user);?>
    
    
    
    
    <footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6 footerleft ">
        <div class="logofooter"> <?= $this->Html->image('logo.svg', ['alt' => 'Logo Mi Retador', 'class' => 'img-responsive logo_footer', 'url' => ['controller' => 'Pages', 'action' => 'display', 'home']]) ?></div>
        <p>A todos nos encanta el futbol, por eso queremos conectar a los fiebres del futbol con los dueños de las canchas y facilitar el proceso de reservar el espacio.</p>
        <p><i class="fa fa-map-pin"></i> Universidad de Costa Rica, San Pedro, Montes de Oca, San José, Costa Rica</p>
        <p><i class="fa fa-phone"></i> Telófono (Costa Rica) : +506 1234 5678</p>
        <p><i class="fa fa-envelope"></i> E-mail : info@miretador.com</p>
        
      </div>
      <div class="col-md-2 col-sm-6 paddingtop-bottom">
        <h6 class="heading7">INFORMACIÓN</h6>
        <ul class="footer-ul">
          <li><a href="#"> Nuestra Historia</a></li>
          <li><a href="#"> Nuestro Equipo</a></li>
          <li><a href="#"> Contáctenos</a></li>
          <li><a href="#"> Terminos y Condiciones</a></li>
          <li><a href="#"> Preguntas Frecuentes</a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-6 paddingtop-bottom">
        <h6 class="heading7">CREADORES</h6>
        <div class="post">
          <p>Kenneth Alonso Calvo Argüello <span>B21250</span></p>
          <p>Johan Stiff Durán Cerdas <span>B42319</span></p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 paddingtop-bottom">
        <div class="fb-page">
            <blockquote cite="https://www.facebook.com/"><a href="https://www.facebook.com/" target="_blank" class="link_fb"><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</a></blockquote>
          
        </div>
      </div>
    </div>
  </div>
</footer>
<!--footer start from here-->

<div class="copyright">
  <div class="container">
    <div class="col-md-6">
      <p>© 2017 - Derechos reservados MiRetador.com</p>
    </div>
    <div class="col-md-6">
      <ul class="bottom_ul">
        <li><?= $this->Html->link('MiRetador.com',  ['controller' => 'Pages', 'action' => 'display', 'home']); ?></li>
        <li><a href="#">Sobre nosotros</a></li>
        <li><a href="#">Faq's</a></li>
        <li><a href="#">Contáctenos</a></li>
      </ul>
    </div>
  </div>
</div>
    
    
</body>
</html>
