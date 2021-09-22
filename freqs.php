<?php

$freq = $_POST["freq"];




$conn = pg_connect("host=127.0.0.1 port=5432 dbname=livetek user=livetek password=l1v3t3k");
#mysqli_close($conn);
$query  = "SELECT valor FROM freq WHERE id_freq= $freq ";
$result = pg_query($conn, $query);
if( !pg_fetch_all($result) ){
    pg_close($conn);
    echo 0;    
}else{
    while ($row = pg_fetch_array($result)) {
        $valor = $row["valor"];
        echo $valor;  
    }
    
}




?>