<?php
$this->assign('title', $user->name);
?>


<section id="perfil">
    <div class="container-fluid user_profile">
        <div class="container" style="margin-top: 30px;">
            <div class="profile-head row">
                <div class="col-md-3 col-sm-3 col-xs-12 foto_nombre">
                    <?php if(isset($user->photo)): ?>
                    <?= $this->Html->image('../files/users/photo/'. $user->photo_dir . '/square_' . $user->photo, ['alt' => 'foto de perfil de ' . $user->name, 'class' => 'img-responsive img-thumbnail-circle']) ?>
                    <?php else: ?>
                    <?= $this->Html->image('logo.png', ['alt' => 'foto de perfil de ' . $user->name, 'class' => 'img-responsive img-thumbnail-circle']) ?>
                    <?php endif; ?>
                </div><!--col-md-4 col-sm-4 col-xs-12 close-->
                
                
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <h5 class = "user-name"><?= h($user->name) ?></h5>
                    <p class ="info"> <?php if($user->owner == 1): ?>
                        Dueño / Jugador
                        <?php else: ?>
                        Jugador
                        <?php endif; ?>
                    </p>
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i> Miembro desde: <?=
                        h($user->created->i18nFormat('MMMM, Y', null, 'es_ES')); 
                        ?></li> 
                        
                        <li><i class="fa fa-phone" aria-hidden="true"></i><?= h($user->phone) ?></li>
                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i><?= h($user->email) ?></li>
                    </ul>

                </div><!--col-md-8 col-sm-8 col-xs-12 close-->
                <div class="col-md-4 col-sm-3 col-xs-12">
                    <h5 class="acerca-de-mi">Acerca de mi:</h5>
                    <p class = "description">
                        <?= h($user->description) ?>
                    </p>
                </div><!--col-md-4 col-sm-4 col-xs-12 close-->

            </div><!--profile-head close-->
            <?php if ($user->owner == 0 || count($fields) == 0): ?>
            
                <div class="row">
                    <div class="ser_dueno">
                        <p class="text">¿Eres dueño de una cancha y quieres formar parte de Mi Retador?</p>
                        <?= $this->Form->postLink('Registrala aquí', ['controller' => 'Users', 'action' => 'owner', $user->id], ['class' => 'btn btn-azul']) ?>
                        
                    </div>
                </div>
            <?php endif; ?>
        </div><!--container close-->
        
        
    </div>
    <div id="sticky" class="container">
        <ul class="nav nav-tabs nav-menu">
            <li>
                <?= $this->Html->link('Editar Perfil', ['controller' => 'Users', 'action' => 'edit', $user->id], ['class' => 'btn btn-azul']);?>
            </li>
            <?php if ($user->owner == 1 && count($fields) > 0): ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn btn-azul" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mis Canchas  <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($fields as $field): ?>
    
                    <li><?= $this->Html->link($field['name'], ['controller' => 'Fields', 'action' => 'view', $field['id'] ]) ?></li>
                    
                    <?php endforeach ?>
                    <li role="separator" class="divider"></li>
                    <li><?= $this->Html->link('Nueva cancha', ['controller' => 'Fields', 'action' => 'add']) ?></li>
                </ul>
            </li>
            <?php endif; ?>
        </ul><!--nav-tabs close-->
    </div>
    
</section>
<main id="favorites-last_games">
    <div class="container padding-top">
        <div class="row">
            
            <div class="col-sm-4 favorites">
                <h5 class="title">Mis canchas favoritas</h5>
                <?php if (!empty($user->fields)): ?>
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user->fields as $field): ?>
                        <tr>
                            <td><?= $this->Html->link($field->name, ['controller' => 'Fields', 'action' => 'visitView', $field->id]) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
                <?php else: ?>
                <p>Aún no tienes canchas favoritas.</p>
                <?php endif; ?>
                
            </div>
            <div class="col-sm-8 last_games">
                <h5 class="title">Siguientes Partidos</h5>
                <?php if (!empty($games)): ?>
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Rival</th>
                            <th>Cancha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($games as $game): ?>
                        <tr>
                            <td><?=
                        h($game->meet->i18nFormat('dd/MM/yyyy HH:mm', null, 'es_ES')); 
                        ?></td>
                            <td><?php if(isset($game->challenger_name)):
                                $name = explode(" ", $game->challenger_name->name);
                                echo $name[0];
                            ?>
                            <?php endif; ?></td>
                            <td><?=
                        h($game->field_name->name); 
                        ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
                <?php else: ?>
                <p>Aún no tienes partidos.</p>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
    
</main>

