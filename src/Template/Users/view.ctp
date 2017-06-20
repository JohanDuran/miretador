<div class="well">
    <h2>Perfil de <?=$user->name?></h2>
    <br>
    <dl>
        <dt>Nombre</dt>
        <dd>
            <?= h($user->name) ?>
            &nbsp;
        </dd>
        <dt>Correo electrónico</dt>
        <dd>
            <?= h($user->email) ?>
            &nbsp;
        </dd>
        <dt>Habilitado</dt>
        <dd>
            <?= h($user->active) ? 'Si' : 'No' ?>
            &nbsp;
        </dd>
        <dt>Teléfono</dt>
        <dd>
            <?= h($user->phone) ?>
            &nbsp;
        </dd>
        <dt>Descripción</dt>
        <dd>
            <?= $this->Text->autoParagraph(h($user->description)); ?>
            &nbsp;
        </dd>
        <dt>Dueño de cancha</dt>
        <dd>
            <?= h($user->owner) ? 'Si' : 'No' ?>
            &nbsp;
        </dd>
        <dt>Creado</dt>
        <dd>
            <?= h($user->created->nice()) ?>
            &nbsp;
        </dd>
        <dt>Modificado</dt>
        <dd>
            <?= h($user->modified->nice()) ?>
            &nbsp;
        </dd>
    </dl>
    
    
    
    
</div>