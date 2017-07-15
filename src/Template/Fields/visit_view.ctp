<?php
    use Cake\I18n\Time;
/**
  * @var \App\View\AppView $this
  */
  $this->Html->script([ 'calendar']);
?>


<section id="perfil_cancha">
    <?= $this->element('fields/fieldProfile'); ?>
    <div id="sticky" class="container">
        <ul class="nav nav-tabs nav-menu">
            <?php if(count($favorite) > 0): ?>
            <li class = "btn btn-azul btn-fav">
                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                <?= $this->Form->postLink(' Agregada', ['controller' => 'UsersFields', 'action' => 'delete', $favorite['id']], [ 'id' => 'eliminar_favorito']);?>
                
            </li>
            <?php else:?>
            <li class = "btn btn-verde btn-fav">
                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                <?= $this->Form->postLink(' Me gusta', ['controller' => 'UsersFields', 'action' => 'add', $current_user['id'], $field->id], [ 'id' => 'agregar_favorito']);?>
            </li>
            <?php endif;?>
          
          
        </ul><!--nav-tabs close-->
    </div>
    
</section>

<main id="horarioVisita">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                
                <h5 class="title">Horario</h5>
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <?php
                                foreach ( $periodo as $dt ) :
                            ?>
                                <th>
                                    <?php 
                                        $now = Time::createFromTimestamp($dt->getTimestamp());
                                        echo $now->i18nFormat('EEEE', null, 'es_ES');
                                    ?>
                                    </br>
                                    <?php
                                        echo $now->i18nFormat('dd/MM/yyyy', null, 'es_ES');
                                    ?>
                                    
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = $field->start; $i < $field->finish; $i++ ): ?>
                            <tr>
                                <td><?php echo $i. ':00'; 
                                    ?>
                                </td>
                                    <?php foreach ( $periodo as $dt ): 
                                        
                                        if($i < 10){
                                            $fecha = $dt->format('Y-m-d') . ' 0' . $i;
                                        }else{
                                            $fecha = $dt->format('Y-m-d') . ' ' . $i;
                                        }
                                        if(isset($partidos[$fecha])): 
                                    ?>
                                        <td> <?= $partidos[$fecha]->user->name ?>
                                        <?php if(isset($partidos[$fecha]->challenger) ): ?>
                                        </br>vs</br><?= $partidos[$fecha]->challenger->name ?><!-- Falta el segundo jugador -->
                                        <?php endif; ?>
                                        
                                        </td> 
                                    <?php else: ?>
                                        <td>
                                        <?php if(isset($current_user)):?>
                                            <?= $this->Form->postLink('Reto', ['controller' => 'UsersGames', 'action' => 'add', $current_user['id'], $field->id, $fecha, 0], ['class' => 'reto_link']); ?>
                                            </br>
                                            <?= $this->Form->postLink('Alquilar', ['controller' => 'UsersGames', 'action' => 'add', $current_user['id'], $field->id, $fecha, 1], ['class' => 'alquilar_link']); ?>
                                        <?php else: ?>
                                            <?= $this->Html->link('Disponible', ['controller' => 'Users', 'action' => 'login'], ['class' => 'disponible_link']); ?>
                                    <?php endif; ?>
                                    </td>
                                        
                                    <?php endif; 
                                    ?>
                                
                                <?php endforeach; ?>
                            </tr>
                        <?php endfor; ?>
                        
                        
                    </tbody>
                </table>
                </div>
                
            </div>
            <div class="col-md-4">
                
                <h5 class="title">Esperando retador</h5>
                <?php if(count($retos)): ?>
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Fecha / Hora</th>
                            <th>Aceptar</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach ($retos as $reto): ?>
                        <tr>
                            <td><?= h($reto->user->name); ?></td>
                            <td>
                                <?php
                                echo $reto->meet->i18nFormat('dd/MM/yyyy HH:mm', null, 'es_ES');
                                ?>
                            </td>
                            <td>
                                <?php if(isset($current_user)):?>
                                    <?= $this->Form->postLink('Aceptar reto', ['controller' => 'UsersGames', 'action' => 'edit', $reto->id, $current_user['id'], $reto->meet->i18nFormat('dd-MM-yyyy HH:mm:ss', null, 'es_ES')], ['class' => 'aceptar']); ?>
                                <?php else: ?>
                                    <?= $this->Html->link('Aceptar reto', ['controller' => 'Users', 'action' => 'login'], ['class' => 'disponible_link']); ?>
                                <?php endif; ?>     
                            </td>
                        </tr>
                        
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
                <?php else: ?>
                <p>No se encuentran retos disponibles.</p>
                <?php endif; ?>
                
                
            </div>
        </div>
    </div>
    
    
</main>




