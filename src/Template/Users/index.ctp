<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
    		<h2>Usuarios</h2>
    	</div>
    	<div class="table-responsive">
    		<table class="table table-striped table-hover">
    		<thead>
    		<tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name', ['Nombre']) ?></th>
                <th><?= $this->Paginator->sort('email', ['Correo electrónico']) ?></th>
                <th><?= $this->Paginator->sort('phone', ['Teléfono']) ?></th>
                <th><?= $this->Paginator->sort('Owner', ['Dueño']) ?></th>
                <th><?= $this->Paginator->sort('description', ['Descripción']) ?></th>
                <th><?= $this->Paginator->sort('photo_dir', ['Foto']) ?></th>
                <th><?= $this->Paginator->sort('role', ['Role']) ?></th>
                <th><?= $this->Paginator->sort('active', ['Activo']) ?></th>
                <th>Acciones</th>
    		</tr>
    		</thead>
    		<tbody>
    		<?php foreach ($users as $user): ?>
    		<tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->phone) ?></td>
                <td><?= h($user->owner? 'Si' : 'No') ?></td>
                <td><?= h($user->description) ?></td>
                <td><?= h($user->photo_dir) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->active? 'Si':'No') ?></td>
                <td>
                    <?= $this->Html->link('Ver', ['action' => 'view', $user->id], ['class' => 'btn btn-sm btn-info']) ?>
                    <?= $this->Html->link('Editar', ['action' => 'edit', $user->id], ['class' => 'btn btn-sm btn-primary']) ?>
                    <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $user->id], ['confirm' => '¿Seguro que desea eliminar el usuario?', 'class' => 'btn btn-sm btn-danger']) ?>
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