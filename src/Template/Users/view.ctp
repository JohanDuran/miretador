<section id="perfil">
    <div class="container-fluid user_profile">
        <div class="container" style="margin-top: 30px;">
            <div class="profile-head">
                <div class="col-md-4 col-sm-3 col-xs-12 foto_nombre">
                    <?= $this->Html->image('../files/users/photo/'. $user->photo_dir . '/square_' . $user->photo, ['alt' => 'foto de perfil de ' . $user->name, 'class' => 'img-responsive img-thumbnail-circle']) ?>
                    
                </div><!--col-md-4 col-sm-4 col-xs-12 close-->
                
                
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <h5 class = "user-name"><?= h($user->name) ?></h5>
                    <p class ="info"> <?php if($user->owner == 1): ?>
                        Dueño / Jugador
                        <?php else: ?>
                        Jugador
                        <?php endif; ?>
                    </p>
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i> Miembro desde: <?=
                        h($user->created->i18nFormat('MMMM, Y', null, 'es_ES')); 
                        ?></li> 
                        
                        <li><i class="fa fa-phone" aria-hidden="true"></i><?= h($user->phone) ?></li>
                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i><?= h($user->email) ?></li>
                    </ul>

                </div><!--col-md-8 col-sm-8 col-xs-12 close-->
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <h5 class="acerca-de-mi">Acerca de mi:</h5>
                    <p class = "description">
                        <?= h($user->description) ?>
                    </p>
                </div><!--col-md-4 col-sm-4 col-xs-12 close-->

            </div><!--profile-head close-->
        </div><!--container close-->
        
        
    </div>
    <div id="sticky" class="container">
        <ul class="nav nav-tabs nav-menu">
          <li>
              <?= $this->Html->link('Editar Perfil', ['controller' => 'Users', 'action' => 'edit', $user->id], ['class' => 'btn btn-azul']);?>
          </li>
        </ul><!--nav-tabs close-->
    </div>
    
    <?php echo $field; ?>
</section>

