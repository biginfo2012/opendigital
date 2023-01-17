<?php
$link = mysqli_connect ( "minha_revisao.mysql.dbaas.com.br" , "minha_revisao" , "Insignus2018@" , "minha_revisao" );

if (! $link ) {
echo "Error: Unable to connect to MySQL." . PHP_EOL ;
echo "Debugging errno: " . mysqli_connect_errno () . PHP_EOL ;
echo "Debugging error: " . mysqli_connect_error () . PHP_EOL ;
exit;
}

echo " A conexão ao banco de dados ocorreu normalmente!" . PHP_EOL ;
echo "Host do servidor: " . mysqli_get_host_info ( $link ) . PHP_EOL ;

mysqli_close ( $link );
?>
