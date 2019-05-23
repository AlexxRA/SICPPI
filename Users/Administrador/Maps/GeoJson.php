<?php
//$Connector = new Connector();
include("../include/conexion.php");

$sql = "SELECT *";
$sql.= " FROM clientes";


$query=mysqli_query($conn, $sql);

$data = array( 'type' => 'FeatureCollection', 'features' => array());
while( $row=mysqli_fetch_array($query) ) {  // preparing an array

    $marker = array(
        'type' => 'Feature',
        'features' => array(
            'type' => 'Feature',
            'properties' => array(
                'nombre' => "".$row["nombre"]."",
                'colonia' => "".$row["colonia"]."",
                'deuda' => "".$row["deuda"]."",
                'marker-color' => '#f00',
                'marker-size' => 'small'
                //'url' =>
            ),
            "geometry" => array(
                'type' => 'Point',
                'coordinates' => array(
                    $row["longitud"],
                    $row["latitud"]
                )
            )
        )
    );
    array_push($data['features'], $marker['features']);

}

echo ("eqfeed_callback(");
echo json_encode($data,JSON_NUMERIC_CHECK);
echo (");");

?>