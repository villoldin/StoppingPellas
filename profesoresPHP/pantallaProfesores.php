<?php
    require "./claseProfesor.php";

    $profesor = new Profesor();

    $dni = $_GET['dni'];

    $listaAsignaturas = $profesor->listarAsignaturas($dni);

    /*error_reporting(E_ERROR | E_PARSE);*/   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profesores</title>
    <style>
        tr, td {
            border: solid 1px black;
        }
    </style>
</head>
<body>
    <h1>Gestor de faltas</h1>
    <form action="pantallaProfesores.php" method="post">
        <select name="selectAsignaturas">
            <?php
                foreach ($listaAsignaturas as $asignatura) {
                    echo "<option value=".$asignatura['cod_asignatura'].">".$asignatura['nombre'];
                }
            ?>
        </select>
        <input type="submit" name="btnBuscar" value="Buscar alumnos">        
    </form>   

    <?php
        if(isset($_POST['btnBuscar'])) {
            $cod_asig = $_POST['selectAsignaturas'];
            $listaAlumnos = $profesor->listarAlumnos($_POST['selectAsignaturas']);
            echo "<form action='guardarFaltas.php?asignatura=".urlencode($cod_asig)."&dniProfe=".urlencode($dni)."' name='faltas' method='post'>";
            echo "<table>";
            echo "<tr><td>APELLIDOS</td><td>NOMBRE</td><td>DNI ALUMNO</td><td>FALTA</td></tr>";
            foreach ($listaAlumnos as $alumno) {
                echo "<tr><td>".$alumno['Apellido1']." ".$alumno['Apellido2']."</td><td>".$alumno['Nombre']."</td><td>".$alumno['dni_alumno']."</td><td><input type='checkbox' name='alumnos[]' value='".$alumno['dni_alumno']."'/></td></tr>";
            }
            echo "</table>";
            echo "<input type='submit' name='ponerFaltas' value='Guardar faltas'>";
                   

            /*$alumnosFaltas = array();
            
            if(isset($_POST['faltas'])) {
                $alumnosFaltas = $_POST['alumnos'];
                echo $alumnosFaltas;
                for ($i=0; $i < count($alumnosFaltas); $i++) { 
                    echo $alumnosFaltas[$i];
                    $fechaActual = date("Y-m-d");
                    $horaActual = date("H:i:s");
                    $fechaActual = date("Y-m-d H:i:s", strtotime($fechaActual . $horaActual));
                    $faltasGuardadas = $profesor->ponerFalta($_POST['selectAsignaturas'], $dni, $alumnosFaltas[$i], $fechaActual);
                } 
            } */
            echo "</form>";
        }
    ?>

</body>
</html>