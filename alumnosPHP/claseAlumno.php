<?php
    require "../Config/conexion.php";

    class Alumno extends Conexion {
        
        public function __construct() {
            parent::__construct();
        }

        // Listamos todas las asignaturas de un DNI

        public function listarAsignaturas($dni) {
            $sql = "SELECT * FROM ASIGNATURAS INNER JOIN ALUMNOS_ASIGNATURAS ON ALUMNOS_ASIGNATURAS.COD_ASIGNATURA=ASIGNATURAS.COD_ASIGNATURA WHERE ALUMNOS_ASIGNATURAS.DNI_ALUMNO = \"$dni\"";
            $resultado = $this->conexion_db->query($sql);
            $listaAsignaturas = $resultado->fetch_all(MYSQLI_ASSOC);
            return $listaAsignaturas;
        }

        // Listamos las faltas por DNI y codigo de la asignatura

        public function listarFaltas($dni, $cod_asig) {
            $sql = "SELECT ASIGNATURAS.NOMBRE AS asignatura, FALTAS.FECHA AS fecha FROM FALTAS INNER JOIN ASIGNATURAS ON FALTAS.COD_ASIGNATURA=ASIGNATURAS.COD_ASIGNATURA WHERE DNI_ALUMNO=\"$dni\" AND FALTAS.COD_ASIGNATURA=\"$cod_asig\"";
            $resultado = $this->conexion_db->query($sql);
            $listaFaltas = $resultado->fetch_all(MYSQLI_ASSOC);
            return $listaFaltas;
        }

        // Contamos las faltas de cada asignatura

        public function listarTodas($dni) {
            $sql = "SELECT ASIGNATURAS.NOMBRE AS asignatura, COUNT(*) AS faltas FROM FALTAS INNER JOIN ASIGNATURAS ON FALTAS.COD_ASIGNATURA=ASIGNATURAS.COD_ASIGNATURA WHERE DNI_ALUMNO=\"$dni\" GROUP BY FALTAS.COD_ASIGNATURA";
            $resultado = $this->conexion_db->query($sql);
            $listaTodas = $resultado->fetch_all(MYSQLI_ASSOC);
            return $listaTodas;
        }

        // Seleccionamos el nombre y apellidos de un determinado DNI

        public function nombre($dni) {
            $sql = "SELECT * FROM ALUMNOS WHERE DNI = \"$dni\"";
            $resultado = $this->conexion_db->query($sql);
            $nombre = $resultado->fetch_all(MYSQLI_ASSOC);
            return $nombre;
        }
    }

?>