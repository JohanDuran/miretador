
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
<html lang="es">
<head>
    <?= $this->Html->charset() ?>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>
        <?= $cakeDescription ?>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['bootstrap', 'style','https://fonts.googleapis.com/icon?family=Material+Icons','browser','//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css']) ?>
    <?= $this->Html->script([ 'jquery-3.2.1.min', 'bootstrap', 'bootstrap-filestyle.min', 'https://use.fontawesome.com/0394caa6cc.js', 'home', $this->request->params['controller'],'browser','//code.jquery.com/jquery-1.10.2.js','//code.jquery.com/ui/1.11.4/jquery-ui.js','//code.jquery.com/ui/1.11.4/jquery-ui.js']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->element('navBar/navBar'); ?>
    <?= $this->element('browser/browser'); ?>

    
    <?= $this->Flash->render() ?>
    
    <?= $this->fetch('content') ?>
    <footer class='footer'>
  <div class='container'>
    <div class='row'>
      <div class='col-md-4 col-sm-6 footerleft '>
        <div class='logofooter'> <?= $this->Html->image('logo.svg', ['alt' => 'Logo Mi Retador', 'class' => 'img-responsive logo_footer', 'url' => ['controller' => 'Pages', 'action' => 'display', 'home']]) ?></div>
        <p>A todos nos encanta el futbol, por eso queremos conectar a los fiebres del futbol con los dueños de las canchas y facilitar el proceso de reservar el espacio.</p>
        <p><i class='fa fa-map-pin'></i> Universidad de Costa Rica, San Pedro, Montes de Oca, San José, Costa Rica</p>
        <p><i class='fa fa-phone'></i> Telófono (Costa Rica) : +506 1234 5678</p>
        <p><i class='fa fa-envelope'></i> E-mail : info@miretador.com</p>
        
      </div>
      <div class='col-md-2 col-sm-6 paddingtop-bottom'>
        <h6 class='heading7'>INFORMACIÓN</h6>
        <ul class='footer-ul'>
          <li><a href='#'> Nuestra Historia</a></li>
          <li><a href='#'> Nuestro Equipo</a></li>
          <li><a href='#'> Contáctenos</a></li>
          <li><a href='#'> Terminos y Condiciones</a></li>
          <li><a href='#'> Preguntas Frecuentes</a></li>
        </ul>
      </div>
      <div class='col-md-3 col-sm-6 paddingtop-bottom'>
        <h6 class='heading7'>CREADORES</h6>
        <div class='post'>
          <p>Kenneth Alonso Calvo Argüello <span>B21250</span></p>
          <p>Johan Stiff Durán Cerdas <span>B42319</span></p>
        </div>
      </div>
      <div class='col-md-3 col-sm-6 paddingtop-bottom'>
        <div class='fb-page'>
            <blockquote cite='https://www.facebook.com/'><a href='https://www.facebook.com/' target='_blank' class='link_fb'><i class='fa fa-facebook-official' aria-hidden='true'></i> Facebook</a></blockquote>
        </div>
      </div>
    </div>
  </div>
</footer>
<!--footer start from here-->

<div class='copyright'>
  <div class='container'>
    <div class='col-md-6'>
      <p>© 2017 - Derechos reservados MiRetador.com</p>
    </div>
    <div class='col-md-6'>
      <ul class='bottom_ul'>
        <li><?= $this->Html->link('MiRetador.com',  ['controller' => 'Pages', 'action' => 'display', 'home']); ?></li>
        <li><a href='#'>Sobre nosotros</a></li>
        <li><a href='#'>Faq's</a></li>
        <li><a href='#'>Contáctenos</a></li>
      </ul>
    </div>
  </div>
</div>      

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW6tU8THzd8Q1jCq1TfU7uO1rsYUYTaVA&libraries=places&callback=initAutocomplete"></script>
 
</body>

</html>
