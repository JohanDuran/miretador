<?php
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
                            <th>Lunes</br>10/07/17</th>
                            <th>Martes</br>11/07/17</th>
                            <th>Míercoles</br>12/07/17</th>
                            <th>Jueves</br>13/07/17</th>
                            <th>Viernes</br>14/07/17</th>
                            <th>Sábado</br>15/07/17</th>
                            <th>Domingo</br>16/07/17</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>15:00</td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td>Jugador 1</br>vs</br>Jugador 2</td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td>Jugador 3</br>vs</br>Jugador 5</td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                        </tr>
                        <tr>
                            <td>16:00</td>
                            <td>Jugador 6</br>vs</br>Jugador 7</td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                        </tr>
                        <tr>
                            <td>17:00</td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td>Jugador 12</br>vs</br>Jugador 15</td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                            <td><a href="#" class="reto_link">Reto</a></br><a href="#" class="alquilar_link">Alquilar</a></td>
                        </tr>
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


<?php print_r($partidos) ?>


