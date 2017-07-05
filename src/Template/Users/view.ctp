<section id="perfil">
    <div class="container-fluid user_profile">
        <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?= $this->Html->image('../files/users/photo/'. $user->photo_dir . '/square_' . $user->photo, ['alt' => 'foto de perfil de ' . $user->name, 'class' => 'img-responsive img-thumbnail-circle']) ?>
            </div>
            <div class="col-sm-7">
                <dd>
                    <?= h($user->name) ?>
                    &nbsp;
                </dd>
                <dd>
                    <?= h($user->email) ?>
                    &nbsp;
                </dd>
            </div>
        </div>
        </div>
    </div>
</section>