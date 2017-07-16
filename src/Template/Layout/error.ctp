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
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['bootstrap', 'style','https://fonts.googleapis.com/icon?family=Material+Icons','browser','//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css']) ?>
    <?= $this->Html->script([ 'jquery-3.2.1.min', 'bootstrap', 'bootstrap-filestyle.min', 'https://use.fontawesome.com/0394caa6cc.js', '//code.jquery.com/jquery-1.10.2.js','//code.jquery.com/ui/1.11.4/jquery-ui.js','//code.jquery.com/ui/1.11.4/jquery-ui.js']) ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    
    
    
    <div id='container'>
        <div id='content'>
            <?= $this->Flash->render() ?>

            <?= $this->fetch('content') ?>
        </div>
    </div>
</body>
</html>
