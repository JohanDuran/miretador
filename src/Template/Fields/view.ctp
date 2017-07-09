<?php
/**
  * @var \App\View\AppView $this
  */
?>


<section id="perfil_cancha">
    <?= $this->element('fields/fieldProfile'); ?>
    <div id="sticky" class="container">
        <ul class="nav nav-tabs nav-menu">
            <li>
                <?= $this->Html->link('Editar Cancha', ['controller' => 'Fields', 'action' => 'edit', $field->id], ['class' => 'btn btn-azul']);?>
            </li>
          
          
        </ul><!--nav-tabs close-->
    </div>
    
</section>






