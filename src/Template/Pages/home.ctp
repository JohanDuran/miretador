<?php
$this->assign('title', 'Home');
?>
      
     
<main>
        <div class="container pasos_confirmados">

                <div class="row">
                        <div class="col-md-8 col-lg-6">
                                <div class = "row">
                                        <div class="col-xs-4 steps">
                                                <div class="step step-1">
                                                        <span class="step-num">1</span>
                                                        <div class="step-header">
                                                              <i class="fa fa-user-plus step-ico" aria-hidden="true"></i>
                                                              <h5 class ="step-title">Registrate</h5>
                                                        </div>
                                                        <div class="caption vista-desktop">
                                                                <p>Se parte de una gran comunidad de fiebres del futbol.</p>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-xs-4 steps">
                                                <div class="step step-2">
                                                        <span class="step-num">2</span>
                                                        <div class="step-header">
                                                              <i class="fa fa-calendar-check-o step-ico" aria-hidden="true"></i>
                                                              <h5 class ="step-title">Agenda</h5>
                                                        </div>
                                                        <div class="caption vista-desktop">
                                                                <p>Se parte de una gran comunidad de fiebres del futbol.</p>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-xs-4 steps">
                                                <div class="step step-3">
                                                        <span class="step-num">3</span>
                                                        <div class="step-header">
                                                              <i class="fa fa-futbol-o step-ico" aria-hidden="true"></i>
                                                              <h5 class ="step-title">Juega</h5>
                                                        </div>
                                                        <div class="caption vista-desktop">
                                                                <p>Se parte de una gran comunidad de fiebres del futbol.</p>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-4 col-lg-6" id="ult_partidos_confirmados">
                                <h5 class="title">Últimos partidos confirmados</h5>
                                <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Equipos</th>
                                            <th>Fecha / Hora</th>
                                            <th>Cancha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                                <td>Jugador 9</br>vs</br>Jugador 2</td>
                                            <td>10/07/17 15:00</td>
                                            <td>Cancha 1</td>
                                        </tr>
                                        <tr>
                                                <td>Jugador 1</td>
                                            <td>11/07/17 16:00</td>
                                            <td>Cancha 2</td>
                                        </tr>
                                         <tr>
                                                 <td>Jugador 3</br>vs</br>Jugador 5</td>
                                            <td>15/07/17 16:00</td>
                                            <td>Cancha 3</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                        </div>
                </div>
        </div>
</main>
<section>
        <div class="container-fluid owner">
                <div class="container">
                        <div class="row">
                                <div class="col-sm-6">
                                        <div class="be_owner">
                                                <h5 class="owner_title">¿Eres dueño de una cancha?</h5>
                                                <?php if(isset($current_user)): ?>
                                                        <?= $this->Form->postLink('Registrala aquí!',
                        ['controller' => 'Users', 'action' => 'owner', $current_user['id']], ['class' => 'btn btn-sm btn-success btn-naranja' ]); //,['confirm'=>'Eres dueño de una cancha de futbol 5?', 'class' => 'btn btn-sm btn-success']); ?>
                                                <?php else: ?>
                                                        <?= $this->Html->link('Registrate para agregar una cancha', ['controller' => 'Users', 'action' => 'add'], ['class' => 'btn btn-success btn-naranja']); ?>
                                                <?php endif; ?>
                                        </div>        
                                </div>
                                <div class="soccer_field vista-desktop">
                                       
                                </div>
                        </div>
                </div>
                
        </div>
</section>