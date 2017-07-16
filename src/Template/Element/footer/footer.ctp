<footer class='footer'>
  <div class='container'>
    <div class='row'>
      <div class='col-md-4 col-sm-6 footerleft '>
        <div class='logofooter'> <?= $this->Html->image('logo.svg', ['alt' => 'Logo Mi Retador', 'class' => 'img-responsive logo_footer', 'url' => ['controller' => 'Pages', 'action' => 'display', 'home']]) ?></div>
        <p>A todos nos encanta el futbol, por eso queremos conectar a los fiebres del futbol con los dueños de las canchas y facilitar el proceso de reservar el espacio.</p>
        <p><i class='fa fa-map-pin'></i> Universidad de Costa Rica, San Pedro, Montes de Oca, San José, Costa Rica</p>
        <p><i class='fa fa-phone'></i> Telófono (Costa Rica) : +506 1234 5678</p>
        <p><i class='fa fa-envelope'></i> E-mail : info@miretador.com</p>
        
      </div>
      <div class='col-md-2 col-sm-6 paddingtop-bottom'>
        <h6 class='heading7'>INFORMACIÓN</h6>
        <ul class='footer-ul'>
          <li><?= $this->Html->link('Nuestra Historia',  ['controller' => 'Pages', 'action' => 'display', 'historia']); ?></li>
          <li><?= $this->Html->link('Nuestro Equipo',  ['controller' => 'Pages', 'action' => 'display', 'equipo']); ?></li>
          <li><a href='#zbwid-4f314329'> Contáctenos</a></li>
          <li><a href='#'> Terminos y Condiciones</a></li>
          <li><a href='#'> Preguntas Frecuentes</a></li>
        </ul>
      </div>
      <div class='col-md-3 col-sm-6 paddingtop-bottom'>
        <h6 class='heading7'>CREADORES</h6>
        <div class='post'>
          <p>Kenneth Alonso Calvo Argüello <span>B21250</span></p>
          <p>Johan Stiff Durán Cerdas <span>B42319</span></p>
        </div>
      </div>
      <div class='col-md-3 col-sm-6 paddingtop-bottom'>
        <div class='fb-page'>
            <blockquote cite='https://www.facebook.com/'><a href='https://www.facebook.com/' target='_blank' class='link_fb'><i class='fa fa-facebook-official' aria-hidden='true'></i> Facebook</a></blockquote>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    (function(d,s,id){var z=d.createElement(s);z.type="text/javascript";z.id=id;z.async=true;z.src="//static.zotabox.com/4/6/46af1d8d4e29ceb84edbd39756dec4fd/widgets.js";var sz=d.getElementsByTagName(s)[0];sz.parentNode.insertBefore(z,sz)}(document,"script","zb-embed-code"));
    </script>
  
</footer>
<!--footer start from here-->

<div class='copyright'>
  <div class='container'>
    <div class='col-md-6'>
      <p>© 2017 - Derechos reservados MiRetador.com</p>
    </div>
    <div class='col-md-6'>
      <ul class='bottom_ul'>
        <li><?= $this->Html->link('MiRetador.com',  ['controller' => 'Pages', 'action' => 'display', 'home']); ?></li>
        <li><a href='#'>Sobre nosotros</a></li>
        <li><a href='#zbwid-4f314329'>Contáctenos</a></li>
        <li><a href='#'>Faq's</a></li>
      </ul>
    </div>
  </div>
</div>  