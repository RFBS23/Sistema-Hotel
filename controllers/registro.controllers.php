<?php
    require_once '../models/registro.models.php';

    if(isset($_GET['operacion'])){
        $usuario = new Registro();

        if ($_GET['operacion'] == 'listarUsuario'){
            $data = $usuario->listarUsuario();
            if ($data){
                foreach ($data as $registro){
                    echo "<tr>
                            <td>{$registro['nombres']}</td>
                            <td>{$registro['apellidos']}</td>
                            <td>{$registro['telefono']}</td>
                            <td>{$registro['nivelacceso']}</td>
                            <td>{$registro['email']}</td>
                            <td>
                                <a href='#' data-ideliminar='{$registro['idusuario']}' class='btn btn-sm btn-danger eliminar'><i class='fa-solid fa-trash'></i></a>
                            </td>
                        </tr>
                    ";
                }
            }
        }

        if ($_GET['operacion'] == 'registrarUsuario'){
            $datos = [
                "apellidos" => $_GET['apellidos'],
                "nombres" => $_GET['nombres'],
                "telefono" => $_GET['telefono'],
                "email" => $_GET['email'],
                "claveacceso" => $_GET['claveacceso'],
                "nivelacceso" => $_GET['nivelacceso']
            ];
            $usuario->registrarUsuario($datos);
        }
    }
?>
