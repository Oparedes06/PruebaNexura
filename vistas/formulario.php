<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>Nexura</title>
</head>
<body>
  <div class="container">
<?php

require_once '../areasModel.php';
require_once '../rolesModel.php';
require_once '../empleadoModel.php';

if(isset($_GET['id']) && $_GET['id'] != "") {
  $emp = new empleadoModel();
  $empleado = $emp->obtener($_GET['id']);
  if(empty($empleado))
    header("Location: ./formulario.php");
  echo "<h1>Actualizar empleado</h1>";
}else{
  $empleado = null;
  echo "<h1>Crear empleado</h1>";
}
echo "<pre>";
if(isset($_POST) && !empty($_POST)){
  //nuevo
  if (is_null($empleado)) {
    $empleadoNuevo = new empleadoModel;
    $empleadoNuevo->nombre = $_POST['nombre'];
    $empleadoNuevo->email = $_POST['email'];
    $empleadoNuevo->sexo = $_POST['sexo'];
    $empleadoNuevo->area = $_POST['area'];
    $empleadoNuevo->descripcion = $_POST['descripcion'];
    if (isset($_POST['recibirBoletin']) && $_POST['recibirBoletin']) {
      $empleadoNuevo->boletin = 1;  
    }else {
      $empleadoNuevo->boletin = 0;
    }
    $id = $empleadoNuevo->guardar();

    $asignacion = new rolesModel;
    foreach ($_POST['rol'] as $rol) {
      $asignacion->asignarEmpleado($rol, $id);
    }
    echo "<script>alert('Empleado creado exitosamente');</script>";
    header("Location: ./formulario.php");
  }else{
    $empleado = new empleadoModel;
    $empleado->nombre = $_POST['nombre'];
    $empleado->email = $_POST['email'];
    $empleado->sexo = $_POST['sexo'];
    $empleado->area = $_POST['area'];
    $empleado->descripcion = $_POST['descripcion'];
    if (isset($_POST['recibirBoletin']) && $_POST['recibirBoletin']) {
      $empleado->boletin = 1;  
    }else {
      $empleado->boletin = 0;
    }
    $empleado->actualizar($_GET['id']);

    $asignacion = new rolesModel;
    foreach ($_POST['rol'] as $rol) {
      $asignacion->asignarEmpleado($rol, $_GET['id']);
    }
    echo "<script>alert('Empleado creado exitosamente');</script>";
    header("Location: ./formulario.php");
  }
}

echo "</pre>";
?>
<div class="alert alert-primary" role="alert">
  Los campos con astericos (*) son obligatorios!
</div>

<form action="./formulario.php" method="post">

    <div class="elem-group">
      <label for="nombre">Nombre Completo *</label>
      <input type="text" id="nombre" name="nombre" placeholder="Nombre completo del empleado" pattern=[A-Z\sa-z]{3,20} value="<?php if (!is_null($empleado)) echo ($empleado[0]->nombre); ?>" required>
    </div>


    <div class="elem-group">
      <label for="email">Correo electronico *</label>
      <input type="email" id="email" name="email" placeholder="Correo electronico" value="<?php if (!is_null($empleado)) echo ($empleado[0]->email); ?>" required>
    </div>


    <div class="elem-group">
      <label for="sexo">Sexo *</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="Femenino"  <?php if (!is_null($empleado) && $empleado[0]->sexo == 'F') echo ' checked'; ?>>
        <label class="form-check-label" for="sexo1">
          Femenino
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="Masculino"  <?php if (!is_null($empleado) && $empleado[0]->sexo == 'M') echo ' checked'; ?>>
        <label class="form-check-label" for="sexo2">
          Masculino
        </label>
      </div>
    </div>


    <div class="elem-group">
      <label for="area">Area *</label>
      <select id="area" name="area" required>
          <?php
          $areas = new areasModel();
          foreach($areas->listar() as $area){
            $selected = "";
            if (!is_null($empleado) && $empleado[0]->area_id == $area->id) 
              $selected = " selected";
            echo "<option value='".$area->id."' ".$selected.">".$area->nombre."</option>";
          }
          ?>
      </select>
    </div>

    <div class="elem-group">
      <label for="descripcion">Descripcion *</label>
      <textarea id="descripcion" name="descripcion" placeholder="Descripción de la experiencia del empleado" required><?php if (!is_null($empleado) && trim($empleado[0]->descripcion) != "") echo $empleado[0]->descripcion; ?></textarea>
    </div>
    
    
    <div class="elem-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="recibirBoletin" id="recibir_boletin" value="true">
        <label class="form-check-label" for="recibir_boletin">
          Deseo recibir boletín informativo
        </label>
      </div>
    </div>

    <div class="elem-group">
      <label for="Roles">Roles *</label>
      <?php
        $roles = new rolesModel;
        foreach ($roles->listar() AS $rol) {
          echo '<div class="form-check">';
          echo '<input class="form-check-input" type="checkbox" name="rol[]" id="'.$rol->id.'" value="'.$rol->id.'">';
          echo '<label class="form-check-label" for="'.$rol->id.'">';
          echo $rol->nombre;
          echo '</label>';
          echo '</div>';
        }
      ?>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="./tabla.php" class="btn btn-secondary">Volver</a>
  </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>