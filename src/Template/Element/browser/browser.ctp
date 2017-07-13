<div class='container' id="browser">
    <?php
        echo $this->Form->create(null, ['url' => ['controller' => 'Fields', 'action' => 'searchResult'], 'class'=>'browser-container', 'id'=>'search-form', 'onSubmit'=>'return validarBuscador();']);
        echo $this->Form->input('byName',['label' => 'Buscar por nombre de cancha','name'=>'byName', 'placeholder' => 'Ej: cancha Mí Retador...', 'class' => 'byName', 'id'=>'autocompleteByName']);
        echo $this->Form->hidden('id',['id'=>'identifier','name'=>'identifier','default'=>'-1']);
        echo $this->Form->hidden('latitude',['id'=>'lat', 'name'=>'lat','default'=>-1]);
        echo $this->Form->hidden('longitude',['id'=>'lng','name'=>'lng','default'=>-1]);
    ?>
    <div class="form-group lugar">
        <label class="control-label" for="byLocation">Cerca de tu ciudad</label>
        <div class="icon-addon addon-md">
            <input type="text" name="byLocation" id='autocomplete' onfocus='geolocate()' placeholder="Ej: Cartago, San José . . ." class="form-control" >
            <i for="byLocation" id='iconMyLocation' class="glyphicon material-icons" onclick='fillInAddressMyLocation()' data-placement="left" data-toggle="tooltip" title="Cerca de tí">my_location</i>
        </div>
    </div>
    <?php
        echo $this->Form->submit('Buscar', ['class' => 'btn-buscar']);
        echo $this->Form->end();
    ?>  
</div>

    
<script>
    //autocompletado del campo buscar por nombre
    $(document).ready(function($){
        $('#autocompleteByName').autocomplete({
        source:'<?php echo Cake\Routing\Router::url(array('controller' => 'Fields', 'action' => 'autocompleteField')); ?>',
        minLength: 1,
        select: function (event, ui) {
    		event.preventDefault();
            $("#autocompleteByName").val(ui.item.label); // display the selected text
            //alert(ui.item.value);
            $("#identifier").val(ui.item.value); // save selected id to hidden input
            /*alert($("#identifier").val());*/
        },
        focus: function( event, ui ) {
            event.preventDefault();
            $("#autocompleteByName").val(ui.item.label); // display the selected text
        } 
    });});
</script>