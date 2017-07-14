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
                                       <td> </td> 
                                    <?php else: ?>
                                    <td>
                                    <?php if(!isset($current_user)):?>
                                        <?= $this->Html->link('Disponible', ['controller' => 'Users', 'action' => 'login'], ['class' => 'disponible_link']); ?>
                                    <?php else: 
                                        $date = new \date_create_from_format('j-M-Y', '15-Feb-2009');;
                                    ?>
                                            
                                        <?= $this->Html->link('Reto', ['controller' => 'UsersGames', 'action' => 'add', $current_user['id'], $field->id, 0], ['class' => 'reto_link']); ?>
                                        </br>
                                        <?= $this->Html->link('Alquilar', ['controller' => 'UsersGames', 'action' => 'add', $current_user['id'], $field->id, 1], ['class' => 'alquilar_link']); ?>
                                            
                                            
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
                        <tr>
                            <td>Jugador 9</td>
                            <td>10/07/17 15:00</td>
                            <td><a href="#" class ="aceptar">Aceptar reto</a></td>
                        </tr>
                        <tr>
                            <td>Jugador 10</td>
                            <td>11/07/17 16:00</td>
                            <td><a href="#" class ="aceptar">Aceptar reto</a></td>
                        </tr>
                         <tr>
                            <td>Jugador 6</td>
                            <td>15/07/17 16:00</td>
                            <td><a href="#" class ="aceptar">Aceptar reto</a></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                
                
            </div>
        </div>
    </div>
    
</main>




