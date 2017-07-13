<?php
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
                            <td>Disponible</td>
                            <td>Disponible</td>
                            <td>Jugador 1</br>vs</br>Jugador 2</td>
                            <td>Disponible</td>
                            <td>Disponible</td>
                            <td>Jugador 3</br>vs</br>Jugador 5</td>
                            <td>Disponible</td>
                        </tr>
                        <tr>
                            <td>16:00</td>
                            <td>Jugador 6</br>vs</br>Jugador 7</td>
                            <td>Disponible</td>
                            <td>Disponible</td>
                            <td>Disponible</td>
                            <td>Disponible</td>
                            <td>Disponible</td>
                            <td>Disponible</td>
                        </tr>
                        <tr>
                            <td>17:00</td>
                            <td>Disponible</td>
                            <td>Disponible</td>
                            <td>Disponible</td>
                            <td>Disponible</td>
                            <td>Jugador 12</br>vs</br>Jugador 15</td>
                            <td>Disponible</td>
                            <td>Disponible</td>
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jugador 9</td>
                            <td>10/07/17 15:00</td>
                        </tr>
                        <tr>
                            <td>Jugador 10</td>
                            <td>11/07/17 16:00</td>
                        </tr>
                         <tr>
                            <td>Jugador 6</td>
                            <td>15/07/17 16:00</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                
                
            </div>
        </div>
    </div>
</section>






