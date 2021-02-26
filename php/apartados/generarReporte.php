<?php
include_once '../db.php';
$datos = array();
<<<<<<< HEAD
$datos['archivo'] = 'ALMACEN,SKU,CONTROL_DIST,CANT_CONTROL,CANT_RECOLECTADO';
=======
$datos['archivo'] = "ALMACEN,CONTROL_DIST,CANT_CONTROL,CANT_RECOLECTADO\n";
>>>>>>> 9b9a5e768bf30dc4e3ca1c88ba912f4ac330ac97
$datos['error'] = array();
$sql_query = "SELECT control_id, cantidad FROM Transaccion WHERE tipo_movimiento='P' AND Date(hora_realizada)=CURDATE()";
$conn = open_database();
$transacciones = array();
$act = 0;
if(($result=mysqli_query($conn,$sql_query))!==FALSE){
    while($fila = mysqli_fetch_array($result)){
        $sku = $fila["control_id"];
        if(isset($transacciones[$sku])){
            $transacciones[$sku] += abs(intval($fila["cantidad"]));
        } 
        else{
            $transacciones[$sku] = abs(intval($fila["cantidad"]));
        }
    }
}
else{
    array_push($datos['error'], "Error " . mysqli_errno($conn) . " : " . mysqli_error($conn));
}
<<<<<<< HEAD
$esq_query = "SELECT id_sucursal, sku, numero_control, apartado FROM Control WHERE control_id=";
=======
$esq_query = "SELECT id_sucursal, numero_control, apartado FROM Control WHERE control_id=";
>>>>>>> 9b9a5e768bf30dc4e3ca1c88ba912f4ac330ac97
foreach($transacciones as $control_id => $valor){
    $sql_query = $esq_query . "'". $control_id . "'";
    if(($result = mysqli_query($conn,$sql_query))!==FALSE){
        while($fila=mysqli_fetch_row($result)){
            foreach($fila as $elem){
                $datos['archivo'] .= $elem . ",";
            }
            $datos['archivo'] .= strval($valor). "\n";
        }
    }
}
//array_push($datos['error'], "Error " . mysqli_errno($conn) . " : " . mysqli_error($conn));
echo json_encode($datos);
?>