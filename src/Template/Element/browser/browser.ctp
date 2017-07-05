<div class='browser-container'>
    <?php
        $this->Form->create();
        echo $this->Form->input('byName',['label' => 'Buscar por nombre de cancha', 'placeholder' => 'Ej: cancha Mí Retador...', 'class' => 'byName']);
        echo $this->Form->input('byLocation',['label' => 'Buscar cerca de tí', 'placeholder' => 'Ej: Cartago, San José...', 'class' => 'byLocation']);
        echo $this->Form->submit('Buscar', ['class'=> 'btn-buscar']);
        $this->Form->end();
    ?>    
</div>


