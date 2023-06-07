<?php

require_once '../model/cliente.php';

if(isset($_POST['operacion'])){

    $cliente = new Clientes();

    if($_POST['operacion'] == 'clientesListar'){
        $data = $cliente->clientes_listar();
        
        if($data){
            foreach($data as $registro){
                echo "
                <tr>
                    <td>{$registro['nombres']}</td>                    
                    <td>{$registro['apellidos']}</td>
                    <td>{$registro['dni']}</td>
                    <td>{$registro['telefono']}</td>
                    <td>{$registro['fechaNac']}</td>                                          
                </tr>          
                ";
            }
        }

        
    }

    if($_POST['operacion'] == 'clientesRegistrar'){
        
        $dataSave = [
            "nombres"   => $_POST['nombres'],
            "apellidos" => $_POST['apellidos'],
            "dni"       => $_POST['dni'],
            "telefono"  => $_POST['telefono'],
            "fechaNac"  => $_POST['fechaNac']
        ];

        $response = $cliente->clientes_registrar($dataSave);
        echo json_encode($response);
    }
}


?>