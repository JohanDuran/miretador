<?php
use Cake\I18n\Time;
$this->assign('title', $field->name);
/**
  * @var \App\View\AppView $this
  */
?>


<section id="perfil_cancha">
    <?= $this->element('fields/fieldProfile'); ?>
    <div id="sticky" class="container">
        <ul class="nav nav-tabs nav-menu">
            <li>
                <?= $this->Html->link('Editar Cancha', ['controller' => 'Fields', 'action' => 'edit', $field->id], ['class' => 'btn btn-azul']);?>
            </li>
          
          
        </ul><!--nav-tabs close-->
    </div>
    
</section>

<section id="horarioDueno">
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
                                                Disponible
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
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Fecha / Hora</th>
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
                        </tr>
                        
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="row" id="map">
        </div>
    </div>
</section>






