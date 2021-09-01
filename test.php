<?php
    require_once 'empleadoModel.php';

    $empleado = new empleadoModel();
    $emp = $empleado->listar();
    print_r($emp);
    echo "<br>";
    
    $emp = $empleado->obtener(1);
    print_r($emp);
    echo "<br>";

    $emp = new empleadoModel();
    $emp->nombre = "Prueba Insert";
    $emp->email = "insert@gmail.com";
    $emp->sexo = "F";
    $emp->area = 1;
    $emp->boletin = "";
    $emp->descripcion = "";
    $emp->guardar();
    
    //$emp->eliminar(3);

    $emp->sexo = "M";
    $emp->actualizar(6);

?>