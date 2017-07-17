<?php
    use Cake\I18n\Time;
    $this->assign('title', $field->name);
/**
  * @var \App\View\AppView $this
  */
  $this->Html->script([ 'calendar']);
?>


<section id="perfil_cancha">
    <?= $this->element('fields/fieldProfile'); ?>
    <div id="sticky" class="container">
        <ul class="nav nav-tabs nav-menu">
            <?php if(count($favorite) > 0 && isset($current_user['id'])): ?>
            <span id='spn_agregada'>
                <li class = "btn btn-azul btn-fav" id="btn_agregada" onclick="deleteFavorite('<?=Cake\Routing\Router::url(array('controller' => 'UsersFields', 'action' => 'deleteAjax',$favorite['id']));?>')">
                    <i class="fa fa-futbol-o" aria-hidden="true"></i>
                    Agregada
                </li>                
            </span>
            
            <span id='spn_me_gusta' hidden>
                <li class = "btn btn-verde btn-fav" id="btn_me_gusta" onclick="addFavorite('<?=Cake\Routing\Router::url(array('controller' => 'UsersFields', 'action' => 'addAjax',$current_user['id'], $field->id));?>')">
                    <i class="fa fa-futbol-o" aria-hidden="true"></i>
                    Me gusta
                </li>
            </span>    
            <?php elseif(isset($current_user['id'])):?>
            <span id='spn_agregada' hidden>
                <li class = "btn btn-azul btn-fav" id="btn_agregada" onclick="deleteFavorite('<?=Cake\Routing\Router::url(array('controller' => 'UsersFields', 'action' => 'deleteAjax',$favorite['id']));?>')">
                    <i class="fa fa-futbol-o" aria-hidden="true"></i>
                    Agregada
                </li>                
            </span>
            
            <span id='spn_me_gusta'>
                <li class = "btn btn-verde btn-fav" id="btn_me_gusta" onclick="addFavorite('<?=Cake\Routing\Router::url(array('controller' => 'UsersFields', 'action' => 'addAjax',$current_user['id'], $field->id));?>')">
                    <i class="fa fa-futbol-o" aria-hidden="true"></i>
                    Me gusta
                </li>
            </span> 
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
                                        if(isset($partidos[$fecha]) && $partidos[$fecha]->state == 1 ): 
                                    ?>
                                        <td><?php
                                            $name = explode(" ",$partidos[$fecha]->user->name);
                                            echo $name[0] ?><?php if(isset($partidos[$fecha]->challenger) ): ?></br>vs</br><?php
                                            $name = explode(" ",$partidos[$fecha]->challenger->name);
                                            echo $name[0] ?><?php endif; ?></td> 
                                    <?php else: ?>
                                        <?php  $today = new \DateTime('NOW');
                                        $today->setTimezone(new \DateTimeZone('America/Costa_Rica'));
                                        
                                        
                                        if($today->format('Y-m-d H') >= $fecha):?>
                                            <td></td>
                                        <?php else: ?>
                                            <td>
                                            <?php if(isset($current_user)):?>
                                                <?= $this->Form->postLink('Alquilar', ['controller' => 'UsersGames', 'action' => 'add', $current_user['id'], $field->id, $fecha, 1], ['class' => 'alquilar_link']); ?>
                                                <?php
                                                    if(!isset($partidos[$fecha])){
                                                        echo "</br>";
                                                        echo $this->Form->postLink('Reto', ['controller' => 'UsersGames', 'action' => 'add', $current_user['id'], $field->id, $fecha, 0], ['class' => 'reto_link']);
                                                    }
                                                ?>
                                            <?php else: ?>
                                                <?= $this->Html->link('Disponible', ['controller' => 'Users', 'action' => 'login', 'state'=>$field->id], ['class' => 'disponible_link']); ?>
                                            <?php endif; ?>
                                            </td>
                                        
                                        <?php endif; ?>
                                        
                                    
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
        <input type="text" name="" id="latVisit" value="<?=$field->latitude ?>" hidden/>
        <input type="text" name="" id="lngVisit" value="<?=$field->longitude ?>" hidden/>

        </div>
        <div class="row" id="map">
        </div>
        
    </div>
    
    
</main>




