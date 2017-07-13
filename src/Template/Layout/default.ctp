
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
    
    <?=$this->element('footer/footer')?>
    
    <!--Para las vistas que contienen mapa dicha vista se encargar de cargar el autocompletado, en caso de no tener mapa se carga solamente el autocompletado-->
    <?php
    $mapFields=['add','edit'];
    if($this->request->controller=='Fields'):?>
            <?php if(in_array($this->request->action,$mapFields)):?>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW6tU8THzd8Q1jCq1TfU7uO1rsYUYTaVA&libraries=places&callback=<?='initMap'.$this->request->controller.'_'.$this->request->action?>"></script>
            <?php endif;?>
    <?php else:?> 
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW6tU8THzd8Q1jCq1TfU7uO1rsYUYTaVA&libraries=places&callback=initAutocomplete"></script>
    <?php endif;?>
</body>

</html>
