<?php
include_once '../../Modelo/configDB.php';
$obejeto=new Conexion();
$conexion= $obejeto->Conectar();

$consulta="select * from UserProfile";//consulta de info 
$resultado=$conexion->prepare($consulta);
$resultado->execute();
$usuarios=$resultado->fetchAll(PDO::FETCH_ASSOC);
print json_encode($usuarios,JSON_UNESCAPED_UNICODE);
print_r(json_decode($usuarios));// se pasa a formato JSON para ser leido por DataTable
/*
foreach($usuarios as $usuario){
    echo "<tr>
    <td>".$usuario['UserId']."</td>
    <td>".$usuario['UserName']."</td>
    <td>".$usuario['HorarioId']."></td>
    <td>".$usuario['SeccionalId']."</td>
    <td>".$usuario['AbogadoId']."></td>
    <td>".$usuario['Email']."</td>
    <td>".$usuario['CarteraTipoId']."</td>
    <td>".$usuario['Fecha']."</td>
    <td>".$usuario['Nombre']."</td>
    </tr>";
}*/