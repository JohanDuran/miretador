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
                        <div class="col-md-4 col-lg-6">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                                magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                                quis nostrud exerci tation ullamcorper suscipit lobortis nisl
                                ut aliquip ex ea commodo consequat. Duis autem vel eum iriure
                                dolor in hendrerit in vulputate velit esse molestie consequat,
                                vel illum dolore eu feugiat nulla facilisis at vero eros et
                                accumsan et iusto odio dignissim qui blandit praesent luptatum
                                zzril delenit augue duis dolore te feugait nulla facilisi.
                                Nam liber tempor cum soluta nobis eleifend option congue
                                nihil imperdiet doming id quod mazim placerat facer possim
                                assum. Typi non habent claritatem insitam; est usus legentis
                                in iis qui facit eorum claritatem. Investigationes
                                demonstraverunt lectores legere me lius quod ii legunt saepius.
                                Claritas est etiam processus dynamicus, qui sequitur mutationem
                                consuetudium lectorum. Mirum est notare quam littera gothica,
                                quam nunc putamus parum claram, anteposuerit litterarum formas
                                humanitatis per seacula quarta decima et quinta decima. Eodem
                                modo typi, qui nunc nobis videntur parum clari, fiant sollemnes
                                in futurum.
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