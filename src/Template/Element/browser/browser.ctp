<div class='browser-container'>
    <?php
        $this->Form->create();
        echo $this->Form->input('byName',['label' => 'Buscar por nombre de cancha', 'placeholder' => 'Ej: cancha Mí Retador...', 'class' => 'byName']);
        echo $this->Form->hidden('latitude',['id'=>'lat']);
        echo $this->Form->hidden('longitude',['id'=>'lng']);
    ?>
    <div class="form-group">
        <label class="control-label" for="byLocation">Cerca de tu ciudad</label>
        <div class="icon-addon addon-md">
            <input type="text" name="byLocation" id='autocomplete' onfocus='geolocate()' placeholder="Ej: Cartago, San Jose . . ." class="form-control" >
            <i for="byLocation" id='iconMyLocation' class="glyphicon material-icons" onclick='fillInAddressMyLocation()' data-placement="left" data-toggle="tooltip" title="Cerca de tí">my_location</i>
        </div>
    </div>
    <?php
        echo $this->Form->submit('Buscar', ['class'=> 'btn-buscar']);
        $this->Form->end();
    ?>  
</div>

<!--
    <div class="form-group text field">
    <label class="control-label" for="bylocation">Buscar cerca de tí</label>
    <input type="text" name="byLocation" placeholder="Ej: Cartago, San José..." class="form-control" id='fileno'>
    <div id="icon_search" style="float: right; margin:auto;">
        <img alt="search" width="16" height="16" src="https://images.duckduckgo.com/iu/?u=http%3A%2F%2Fwww.clker.com%2Fcliparts%2F0%2F1%2FS%2F1%2Fl%2FW%2Fsearch-icon-hi.png&f=1" />
    </div>
    </div>-->