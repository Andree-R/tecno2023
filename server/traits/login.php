<?php

use Persona;

trait managementSession
{
  public function __construct()
  {
    $this->validar();
  }

  public function validar()
  {

    if (isset($_SESSION["session_id"])) {
      $this->showViewLogin();
    }
    if ($_POST["usuario"] && $_POST["clave"]) {


      // var_dump("<pre>",$data,"</pre>");exit;


    }
  }

  public function getUser(): array
  {
    $user = $_POST['usuario'];
    $contraseña = $_POST['clave'];
    $obj = new Persona();
    $data = $obj->validar($user, $contraseña)['data'][0];

    return $data;
  }

  public function setUser($data)
  {
    if (!is_null($data)) {
      $_SESSION['id'] = $data['id'];
      $_SESSION['usuario'] = $data['usuario'];
      $_SESSION['nombre'] = $data['nombres'] . ' ' . $data['apellidos'];

      $_SESSION['menu'] = $this->getMenu();

      # var_dump($_SESSION);exit;
    }
    header("Location: ?");
  }

  public function showViewLogin()
  {
    $home = $this->mostrar('personas/login.php', null, true);

    $datos = [
      'contenido' => $home,
    ];

    $this->mostrar('./plantilla/home.php', $datos);
  }

  public function getMenu(): array
  {
    $obj = new Modulo();

    return [];
  }
}
