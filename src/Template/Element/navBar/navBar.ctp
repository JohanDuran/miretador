<!-- NAV -->

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?= $this->Html->image('logo.svg', ['alt' => 'Logo Mi Retador', 'class' => 'navbar-brand img-responsive logo_menu', 'url' => ['controller' => 'Pages', 'action' => 'display', 'home']]) ?>
            <?= $this->Html->link('Mi Retador', ['controller' => 'Pages', 'action' => 'display', 'home' ], ['class' => 'brand_name navbar-brand']) ?> 
    
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if(isset($current_user)): ?>
            <?php if($current_user['role'] == 'admin'): ?>
            <ul class="nav navbar-nav">
                
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrador  <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><?= $this->Html->link('Usuarios', ['controller' => 'Users', 'action' => 'index', $current_user['id'] ]) ?></li>
                    <li><?= $this->Html->link('Canchas', ['controller' => 'Fields', 'action' => 'index', $current_user['id'] ]) ?></li>
                </ul>
                </li>
            
            </ul>
            <?php endif; ?>
            
            <ul class="nav navbar-nav navbar-right">
            
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user icon-fa" aria-hidden="true"></i> Hola, <?= h($current_user['name']); ?>  <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link('Mi perfil', ['controller' => 'Users', 'action' => 'view', $current_user['id'] ]) ?></li>
                        <li role="separator" class="divider"></li>
                        <li><?= $this->Html->link('Editar perfil', ['controller' => 'Users', 'action' => 'edit', $current_user['id'] ]) ?></li>
                        <li><?= $this->Html->link('Cerrar sesión', ['controller' => 'Users', 'action' => 'logout' ], ['class' => '']) ?></li>
                    </ul>
                </li>
            
            </ul>
            <?php else: ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><?= $this->Html->link('Iniciar sesión', ['controller' => 'Users', 'action' => 'login' ], ['class' => 'login-button']) ?></li>
                </ul>
            <?php endif; ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>