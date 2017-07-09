<?php
    if(isset($field->photo)):
    ?>
    <div class="container_fuild">
                
        <?= $this->Html->image('../files/fields/photo/'. $field->photo_dir . '/landscape_' . $field->photo, ['alt' => 'foto de la cancha ' . $field->name, 'class' => 'img-responsive field_img']) ?>
                    
                
    </div>
    <?php endif; ?>
    <div class="container-fluid field_profile">
        <div class="container" style="">
            <div class="profile-head">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <h5 class = "field-name"><?= h($field->name) ?></h5>
                    <p class ="info"> 
                       Dueño: <?= h($owner->name) ?>
                    </p>

                </div><!--col-md-8 col-sm-8 col-xs-12 close-->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <h5 class="acerca-de-mi">Descripción de la cancha:</h5>
                    <p class = "description">
                        <?= h($field->description) ?>
                    </p>
                </div><!--col-md-4 col-sm-4 col-xs-12 close-->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <ul>
                        <li><i aria-hidden="true">¢</i>  <?=
                        $this->Number->format($field->price); 
                        ?> por equipo</li> 
                        
                        <li><i class="fa fa-phone" aria-hidden="true"></i><?= h($field->contact) ?></li>
                    </ul>
                </div><!--col-md-4 col-sm-4 col-xs-12 close-->

            </div><!--profile-head close-->
        </div><!--container close-->
        
        
    </div>