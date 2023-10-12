<?php

class Permisos implements Observer
{
  public function update()
  {
    // Lógica para actualizar permisos cuando se notifica un cambio en RolesManager
    echo "Los permisos se han actualizado.\n";
  }
}
