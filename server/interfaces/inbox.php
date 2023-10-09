<?php 

interface Inbox{
  public function buscarMensaje();
  public function mostrarMensajes();
  public function mostrarArchivados();
  public function mostrarPapelera();
  public function enviarMensaje();
  public function editarMensaje();
  public function eliminarMensaje();
}

?>