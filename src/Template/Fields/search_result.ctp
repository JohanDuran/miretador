<section id="busqueda">
    <div class="container">
        
        <div class="cant_resultados_container">
            <div class="cantidad_resultados">
                <span class="num_resultados">
                    <?php 
                    $count = 0;
                        if(isset($byId)){
                            $count += 1;
                        }
                        if(isset($byName)){
                            $count += count($byName);
                        }
                        if(isset($byLocation)){
                            $count+=count($byLocation);
                        }
                    echo $count ?></span> 
                <div class ="titulo">
                    <span class ="resultados_titulo"> Resultados para:</span> 
                    <span class ="resultados_para"> <?php if(isset($name)){
                    h($name);}  ?></span>  <!-- Cambiar por la busqueda. -->
                </div>
            </div>
            
        </div>
        
        
        
        
        <div class="filtros vista-desktop-wide">
            <p>Aquí van los filtros.</p>
        </div>
        <div class="resultados">
            <?php if(isset($byId)):?>
                <div class="info_busqueda">
                    <?php
                    if(isset($byId->photo)):
                    ?>
                    <div class="row border_2 border_bottom_none">
                        <div class="col-xs-12 img_field">           
                            <?= $this->Html->image('../files/fields/photo/'. $byId->photo_dir . '/landscape_' . $byId->photo, ['alt' => 'foto de la cancha ' . $byId->name, 'class' => 'img-responsive']) ?>       
                        </div>
                    </div>
                    
                    <?php endif; ?>
                    <div class="row info_principal border_2 border_bottom_none">
                        <div class="col-sm-7">
                            <?= $this->Html->Link($byId->name, ['controller' => 'Fields', 'action' => 'visitView', $byId->id], ['class'=> 'field_name']); ?>
                            <?php if(isset($byId->distance)): ?>
                                </br><span> A <?= h(number_format($byId->distance,2))?>km de distancia.</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-5 price">
                            <span><span class="price_number">¢ <?= $this->Number->format($byId->price)?></span> <br class="vista-desktop">por equipo.</span>
                        </div>
                    </div>
                    <div class="row info_principal border_2 border_bottom_none">
                        <div class="col-sm-7 description">
                            <span>
                                <?php
                                
                                if(strlen($byId->description) > 150){
                                     echo h(substr($byId->description, 0, 150)) . '...' .  $this->Html->Link('ver mas', ['controller' => 'Fields', 'action' => 'visitView', $byId->id]); 
                                }
                                else{
                                    echo h($byId->description);
                                }
                                
                                ?>
                                
                                </span>
                        </div>
                        <div class="col-sm-5 schedule">
                            <span>Abierto desde las <span class = "bold"><?= h($byId->start) ?></span> hasta las <span class = "bold"><?= h($byId->finish) ?></span> horas.</span>
                        </div>
                    </div>
                    <div class="row border_2">
                        <div class="col-xs-12">
                            Mapa
                        </div>
                    </div>
                    
                </div>
                
                
            <?php endif;
            if(isset($byName)):
                foreach($byName as $field): ?>
                    
                    <div class="info_busqueda">
                        <?php
                        if(isset($field->photo)):
                        ?>
                        <div class="row border_2 border_bottom_none">
                            <div class="col-xs-12 img_field">           
                                <?= $this->Html->image('../files/fields/photo/'. $field->photo_dir . '/landscape_' . $field->photo, ['alt' => 'foto de la cancha ' . $field->name, 'class' => 'img-responsive']) ?>       
                            </div>
                        </div>
                        
                        <?php endif; ?>
                        <div class="row info_principal border_2 border_bottom_none">
                            <div class="col-sm-7">
                                <?= $this->Html->Link($field->name, ['controller' => 'Fields', 'action' => 'visitView', $field->id], ['class'=> 'field_name']); ?>
                                <?php if(isset($field->distance)): ?>
                                    </br><span> A <?= h(number_format($field->distance,2))?>km de distancia.</span>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-5 price">
                                <span><span class="price_number">¢ <?= $this->Number->format($field->price)?></span> <br class="vista-desktop">por equipo.</span>
                            </div>
                        </div>
                        <div class="row info_principal border_2 border_bottom_none">
                            <div class="col-sm-7 description">
                                <span>
                                    <?php
                                    
                                    if(strlen($field->description) > 150){
                                         echo h(substr($field->description, 0, 150)) . '...' .  $this->Html->Link('ver mas', ['controller' => 'Fields', 'action' => 'visitView', $field->id]); 
                                    }
                                    else{
                                        echo h($field->description);
                                    }
                                    
                                    ?>
                                    
                                    </span>
                            </div>
                            <div class="col-sm-5 schedule">
                                <span>Abierto desde las <?= h($field->start) ?> hasta las <?= h($field->finish) ?> horas.</span>
                            </div>
                        </div>
                        <div class="row border_2">
                            <div class="col-xs-12">
                                Mapa
                            </div>
                        </div>
                    </div>
                    
            <?php endforeach;
                
            endif;
                
        ?>
            
         
        </div>
        
        
    </div>
</section>