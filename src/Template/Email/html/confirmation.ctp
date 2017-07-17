Hola, <?= $user['username'] ?>

Su partido del día <?= $user['fecha'] ?> a la hora <?= $user['hora'] ?> ha sido confirmado.

Jugarás en la cancha <?= $user['field'] ?>.

Muchas gracias por escogernos,

<?= $this->Email->link('Mi Retador', ['controller' => 'Pages', 'action' => 'display' , 'home']) ?>

<?= $this->Email->image('logo.png') ?>