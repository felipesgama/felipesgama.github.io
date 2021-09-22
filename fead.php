<?php

$pixel = $_POST["fead_out"];

if( empty($_POST["fead_out"]) || empty($_POST["fead_in"]) ){
    header('Location: fead.html');
    exit;
}


$conn = pg_connect("host=127.0.0.1 port=5432 dbname=livetek user=livetek password=l1v3t3k");
#mysqli_close($conn);
$query  = "SELECT id_fita FROM fita WHERE fita = 1 ";
$result = pg_query($conn, $query);

if( !pg_fetch_all($result) ){
    $values = array(
        "fead_out"   => $_POST["fead_out"],
        "fead_in"  => $_POST["fead_in"],
    );
    pg_insert($conn,"fita",$values);
    
}else{
    while ($row = pg_fetch_array($result)) {
        $id_fita = $row["id_fita"];
        $values = array(
            "fead_out"   => $_POST["fead_out"],
            "fead_in"  => $_POST["fead_in"],
        );
        $res = pg_update($conn, 'fita', $values, array( "id_fita" => $id_fita ));
    
    }
    
}
pg_close($conn);
header('Location: fead.html');
exit;


?>
