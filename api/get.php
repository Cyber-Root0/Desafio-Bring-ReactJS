<?php
include_once 'mysql.php';
header('Content-Type: application/json');
$array=array();
//verificando se existe parametro ID por GET
if ( !empty($_GET['id'])  ){
    $id=addslashes($_GET['id']);
    $jogo= new BancoDados();
    $jogo->conectar();  
    $output=$jogo->select(intval($id)); 
    json($output); 
}else{
    $jogo= new BancoDados();
    $jogo->conectar();  
    $output=$jogo->select(0); 
    json($output);
}

function json($dado){
    echo json_encode(mysqli_fetch_all($dado),JSON_PRETTY_PRINT);
    
}

?>