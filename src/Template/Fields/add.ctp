<section id="agregar_cancha">
    <div class="container">
<div class="fields form large-9 medium-8 columns content">
    <?= $this->Form->create($field, ['type' => 'file'])?>
    <fieldset>
        <legend><?= __('Agregar una cancha') ?></legend>
        <?= $this->element('fields/form'); ?>
    </fieldset>
    <?= $this->Form->button(__('Agregar'), ['class'=> 'btn btn-success btn-cancha-add']) ?>
    <?= $this->Form->end() ?>
</div>
    
<!--Carga del mapa-->    
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW6tU8THzd8Q1jCq1TfU7uO1rsYUYTaVA&libraries=places&callback=initMapAdd"></script>
-->
</div>
</section>