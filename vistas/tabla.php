<?php
    require_once '../empleadoModel.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexura</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-9">
            <h1>Lista de empleados</h1>
        </div>
        <div class="col-2">
            <a href="./formulario.php" class="btn btn-primary float-right">Crear</a>
        </div>
    </div>
    
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Sexo</th>
      <th scope="col">Area</th>
      <th scope="col">Boletìn</th>
      <th scope="col">Modificar</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $empleados = new empleadoModel();
        foreach ($empleados->listar() AS $data) {
            echo "<tr>";
            echo "<td>".$data->nombre."</td>";
            echo "<td>".$data->email."</td>";
            echo "<td>".$data->sexo."</td>";
            echo "<td>".$data->area."</td>";
            echo "<td>".$data->boletin."</td>";
            echo '<td><a href="./formulario.php?id='.$data->id.'">Editar</a></td>';
            echo '<td><a href="">Eliminar</a></td>';
            echo "</tr>";
        }
      ?>
    </tbody>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>