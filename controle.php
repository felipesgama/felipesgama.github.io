<?php

$pixel = $_POST["pixel"];

if( empty($_POST["pixel"]) || empty($_POST["red"]) || empty($_POST["blue"]) ||
empty($_POST["green"]) ){
    header('Location: index.html');
    exit;
}


$conn = pg_connect("host=127.0.0.1 port=5432 dbname=livetek user=livetek password=l1v3t3k");
#mysqli_close($conn);
$query  = "SELECT id_pixel FROM pixel WHERE pixel = $pixel ";
$result = pg_query($conn, $query);

if( !pg_fetch_all($result) ){
    $values = array(
        "red"   => $_POST["red"],
        "blue"  => $_POST["blue"],
        "green" => $_POST["green"],
        "pixel" => $_POST["pixel"],
    );
    pg_insert($conn,"pixel",$values);
    
}else{
    while ($row = pg_fetch_array($result)) {
        $id_pixel = $row["id_pixel"];
        $values = array(
            "red"   => $_POST["red"],
            "blue"  => $_POST["blue"],
            "green" => $_POST["green"],
            "pixel" => $_POST["pixel"],
        );
        $res = pg_update($conn, 'pixel', $values, array( "id_pixel" => $id_pixel ));
    
    }
    
}
pg_close($conn);
header('Location: index.html');
exit;


?>
