<section id="perfil">
    <div class="container-fluid user_profile">
        <div class="container" style="margin-top: 30px;">
            <div class="profile-head">
                <div class="col-md- col-sm-4 col-xs-12">
                    <?= $this->Html->image('../files/users/photo/'. $user->photo_dir . '/square_' . $user->photo, ['alt' => 'foto de perfil de ' . $user->name, 'class' => 'img-responsive img-thumbnail-circle']) ?>
                    <h6><?= h($user->name) ?></h6>
                </div><!--col-md-4 col-sm-4 col-xs-12 close-->
                
                
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <h5><?= h($user->name) ?></h5>
                    <p> <?php if($user->owner == 1): ?>
                        Dueño / Jugador
                        <?php else: ?>
                        Jugador
                        <?php endif; ?>
                         </p>
                    <ul>
                        <?php
                            use Cake\I18n\Time;
                            Time::setDefaultLocale('es-ES');
                        ?>
                        <li><span class="glyphicon glyphicon-briefcase"></span> Miembro desde: <?=
                        h($user->created->format('F, Y')); 
                        ?></li> 
                        <li><span class="glyphicon glyphicon-phone"></span><?= h($user->phone) ?></li>
                        <li><span class="glyphicon glyphicon-envelope"></span><?= h($user->email) ?></li>
                    </ul>

                </div><!--col-md-8 col-sm-8 col-xs-12 close-->

            </div><!--profile-head close-->
        </div><!--container close-->
        
        <div class="container">
        <div class="row">
            <div class="col-sm-4">
                
            </div>
            <div class="col-sm-7">
                    <?= h($user->name) ?>
                    <?= h($user->email) ?>
                </dd>
            </div>
        </div>
        </div>
    </div>
</section>

