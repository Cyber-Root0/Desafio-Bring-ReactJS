<?php
include_once 'mysql.php';
if (!empty($_GET['ganhador']) &&  !empty($_GET['h'])){
	$ganhador=addslashes($_GET['ganhador']);
	$h=addslashes($_GET['h']);
	$historicos=organizaHistorico($h);
	$h_x=$historicos["h_x"];
	$h_o=$historicos["h_o"];
	$jogo=new BancoDados();
	$jogo->conectar();
	if ($jogo->insert($ganhador,$h_x,$h_o)){
		$json=array();
		$json['cod']="200";
		echo json_encode($json,JSON_PRETTY_PRINT);
	}else{

	}   
}else{
	$json=array();
	$json['cod']="404";
	echo json_encode($json,JSON_PRETTY_PRINT);
}

function organizaHistorico($h){
	$output=array();
	$str= explode(",", $h);
	$h_x="";
	$h_o="";
	for ($i=0;$i<count($str);$i++){
		if ($str[$i]==""){

		}else{
			//se n estiver nulo os campos
			if ($str[$i]=="X"){
				
				if ($h_x!=null){
					$h_x=$h_x.",".strval($i);
				}else{
					$h_x=strval($i);
				}
				

			}elseif ($str[$i]=="O") {
				if ($h_o!=null){
					$h_o=$h_o.",".strval($i);
				}else{
					$h_o=strval($i);
				}
				
			}
		}
	}
	$output["h_x"]=$h_x;
	$output["h_o"]=$h_o;
	return $output;
}

?>
