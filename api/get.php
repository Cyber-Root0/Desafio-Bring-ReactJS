<?php
header('Content-Type: application/json');
include_once 'mysql.php';
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
    while($object = mysqli_fetch_assoc($dado)){
        $array[]=$object;
    }
    echo json_encode($array,JSON_PRETTY_PRINT);
    
}

?>
