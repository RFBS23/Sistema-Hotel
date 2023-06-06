<?php
require_once '../model/usuarioNew.php';

if(isset($_POST['operacion'])){

  $users = new Users();

  if($_POST['operacion'] == 'usersGet'){
    $data = $users->usuarios_get();

    if($data){
        foreach($data as $registro){
            echo "
            <tr>
                <td>{$registro['idusuario']}</td>
                <td>{$registro['nombres']}</td>
                <td>{$registro['apellidos']}</td>
                <td>{$registro['email']}</td>
                <td>{$registro['nombreusuario']}</td>                              
            </tr>          
            ";
        }
    }
}
}

?>