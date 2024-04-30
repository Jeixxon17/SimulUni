<?php

include("../db/database.php");

$columns = ['monto_prestamo','tasa_interes_anual','plazo_meses','total_intereses','pago_mensual'];
$table = "simulaciones";

$campo = isset($_POST['campo']) ? $conexionDB->real_escape_string($POST['campo']) : null; 

$sql = "SELECT " .implode(", ", $columns) ." FROM $table";
$result = $conexionDB->query($sql);
$num_rows = $result->num_rows;

$html = "";

if($num_rows > 0){
 while($row = $result->fetch_assoc()){
    $html .= '<tr>';
    $html .= '<td>' .$row['monto_prestamo']. '</td>';
    $html .= '<td>' .$row['tasa_interes_anual']. '</td>';
    $html .= '<td>' .$row['plazo_meses']. '</td>';
    $html .= '<td>' .$row['total_intereses']. '</td>';
    $html .= '<td>' .$row['pago_mensual']. '</td>';
    $html .= '<td><a href="">Mostrar</a></td>';
    $html .= '<td><a href="">Eliminar</a></td>';
    $html .= '</tr>';
 }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>