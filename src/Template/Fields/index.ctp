<?php
/**
  * @var \App\View\AppView $this
  */
?>


<div class="container"><div class="row">
    <div class="col-md-12">
    	<div class="page-header">
    		<h2>Canchas</h2>
    	</div>
    	<div class="table-responsive">
    		<table class="table table-striped table-hover">
    		<thead>
    		<tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id del usuario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('latitud') ?></th>
                <th scope="col"><?= $this->Paginator->sort('longitud') ?></th>
                <th scope="col"><?= $this->Paginator->sort('precio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contacto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('inicio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cierre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('foto') ?></th>
                <th>Acciones</th>
    		</tr>
    		</thead>
    		<tbody>
    		<?php foreach ($fields as $field): ?>
    		<tr>
                <td><?= $this->Number->format($field->id) ?></td>
                <td><?= $this->Number->format($field->user_id) ?></td>
                <td><?= h($field->name) ?></td>
                <td><?= h($field->latitude) ?></td>
                <td><?= h($field->longitude) ?></td>
                <td><?= $this->Number->format($field->price) ?></td>
                <td><?= h($field->contact) ?></td>
                <td><?= h($field->start) ?></td>
                <td><?= h($field->finish) ?></td>
                <td><?= h($field->photo) ?></td>
                <td>
                    <?= $this->Html->link('Ver', ['action' => 'view', $field->id], ['class' => 'btn btn-sm btn-info']) ?>
                    <?= $this->Html->link('Editar', ['action' => 'edit', $field->id], ['class' => 'btn btn-sm btn-primary']) ?>
                    <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $field->id], ['confirm' => '¿Seguro que desea eliminar esta cancha?', 'class' => 'btn btn-sm btn-danger']) ?>
                </td>
    		</tr>
    	<?php endforeach; ?>
    		</tbody>
    		</table>
    	</div>

        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< Anterior') ?>
                <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                <?= $this->Paginator->next('Siguiente >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>
</div>


