<?php
$USUARIO = $USUARIO ?? null;

if (!is_object($USUARIO) || !method_exists($USUARIO, 'getTipoEnObjeto')) {
  return;
}
?>

<div class="welcome-shell">
  <div class="welcome-hero">
    <div class="welcome-hero__icon">
      <i class="ion ion-md-people"></i>
    </div>
    <span class="welcome-kicker">Kit de herramientas</span>
    <h1>Bienvenido al sistema de gesti&oacute;n humana</h1>
    <p>Accede a las herramientas necesarias para gestionar el talento humano de Medicron. Selecciona una opci&oacute;n del men&uacute; lateral para comenzar.</p>
    <span class="welcome-badge">V 1.2.2</span>
  </div>

  <div class="welcome-summary">
    <div class="welcome-card">
      <span class="welcome-card__label">Usuario</span>
      <strong><?= $USUARIO ?></strong>
    </div>
    <div class="welcome-card">
      <span class="welcome-card__label">Rol</span>
      <strong><?= $USUARIO->getTipoEnObjeto() ?></strong>
    </div>
    <div class="welcome-card">
      <span class="welcome-card__label">Estado</span>
      <strong>Sesión activa</strong>
    </div>
  </div>
</div>
