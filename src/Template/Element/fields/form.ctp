<?php
    echo $this->Form->input('name', ['label' => 'Nombre']);
    echo "<label class='control-label'>Seleccione la ubicación de su cancha</label>";
    echo "<div id='map'></div>";
    echo $this->Form->hidden('latitude',['id'=>'lat']);
    echo $this->Form->hidden('longitude',['id'=>'lng']);
    echo $this->Form->input('price', ['label' => 'Precio por equipo']);
    echo $this->Form->input('contact', ['label' => 'Teléfono']);
?>

<div class="row">
    <div class="col-xs-6 col-md-2">
        <?php
            echo $this->Form->input('start', [ 'min'=>'0', 'max'=>'23','id'=>'inicio','onchange'=>'inicioChange()','oninput'=>'revisarNumero(this)', 'label' => 'Hora de inicio']);
        ?>
    </div>
    <div class="col-xs-6 col-md-2">
        <?php
           echo $this->Form->input('finish', [ 'min'=>'0', 'max'=>'23','id'=>'fin' ,'onchange'=>'finChange()', 'oninput'=>'revisarNumero(this)', 'label' => 'Hora de cierre']);
        ?>
    </div>
</div>
<?php
    echo $this->Form->input('photo', ['type' => 'file', 'class' => 'filestyle', 'data-buttonName' => 'btn-primary', 'data-buttonText' => 'Examinar', 'data-placeholder'=>"Aún no se ha selecionado una imagen", 'data-iconName'=>' fa fa-file-image-o', 'label' => 'Foto']);
    //echo $this->Form->input('users._ids', ['options' => $users]);
    echo $this->Form->input('description', ['label' => 'Descripción']);
?>