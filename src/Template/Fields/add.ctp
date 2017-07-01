
<div class="fields form large-9 medium-8 columns content">
    <?= $this->Form->create($field, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add Field') ?></legend>
        <?php
            //echo $this->Form->input('user_id', ['value'=> $current_user['id'], 'disabled']);
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('latitude');
            echo $this->Form->input('longitude');
            echo $this->Form->input('price');
            echo $this->Form->input('contact');
        ?>
        <div class="row">
            <div class="col-xs-6 col-md-2">
                <?php
                    echo $this->Form->input('start', [ 'min'=>'0', 'max'=>'23','id'=>'inicio','onchange'=>'inicioChange()','oninput'=>'revisarNumero(this)']);
                ?>
            </div>
            <div class="col-xs-6 col-md-2">
                <?php
                   echo $this->Form->input('finish', [ 'min'=>'0', 'max'=>'23','id'=>'fin' ,'onchange'=>'finChange()', 'oninput'=>'revisarNumero(this)']);
                ?>
            </div>
        </div>
        <?php
            echo $this->Form->input('photo', ['type' => 'file', 'class' => 'filestyle', 'data-buttonName' => 'btn-primary', 'data-buttonText' => 'Examinar', 'data-placeholder'=>"Aún no se ha selecionado una imagen", 'data-iconName'=>' fa fa-file-image-o']);
            //echo $this->Form->input('users._ids', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=> 'btn btn-success btn-cancha-add']) ?>
    <?= $this->Form->end() ?>
</div>


