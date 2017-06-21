<?= $this->Html->css('sesion') ?>

<div class="container">
    

    <div class="col-md-10 col-md-offset-1 main" >
        <div class="col-md-6 left-side" >
            <?= $this->Html->image('logo.svg', ['alt' => 'Logo Mi Retador', 'class' => 'img-responsive  center-block logo', 'url' => ['controller' => 'Pages', 'action' => 'display', 'home']]) ?>
            
            <h3 class="center-block"><?= $this->Html->link('Mi Retador', ['controller' => 'Pages', 'action' => 'display', 'home' ])?></h3>
            <p class="center-block">Conectarse a MIRETADOR.COM</p>
            <br>
        
        
        </div><!--col-sm-6-->
    
        <div class="col-md-6 right-side">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create() ?>
            <h3>Iniciar Sesión</h3>
            
            <!--Form with header-->
            <div class="form">
            
            
                <div class="form-group">
                    
                    <?= $this->Form->input('email', ['class' => 'form-control input-lg', 'placeholder' => 'Correo electrónico', 'label' => false, 'required']) ?>
                    
                </div>
                
                <div class="form-group">
                    <?= $this->Form->input('password', ['class' => 'form-control input-lg', 'placeholder' => 'Contraseña', 'label' => false, 'required']) ?>
                   
                </div>
                
                <div class="text-xs-center">
                    <?= $this->Form->submit('Ingresar', ['class' => 'btn btn-deep btn-green' ]) ?>
                    <?= $this->Html->link('Registrarse', ['controller' => 'Users', 'action' => 'add' ], ['class' => 'btn btn-deep btn-blue']) ?>
                </div>
            
            </div>
            <!--/Form with header-->
        <?= $this->Form->end() ?>
        </div><!--col-sm-6-->
    
    </div><!--col-sm-8-->

</div><!--container-->