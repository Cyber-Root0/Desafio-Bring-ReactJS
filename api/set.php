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
		if (empty($str[$i])){
		}else{
			// execuxão de apenas OS CAMPOS Nao Nulos
			if($str[$i]=="X"){
				if (empty($h_x)){		
					$h_x=$i;
				}else{
					$h_x=$h_x.",".$i;
				}

				//if ($i==0){
				//$h_x=$i;
				//}else{
				//	$h_x=$h_x.",".$i;
				//}
				
			}else{
				if (empty($h_o)){		
					$h_o=$i;
				}else{
					$h_o=$h_o.",".$i;
				}
			}
		}
	}
	$output["h_x"]=$h_x;
	$output["h_o"]=$h_o;
	return $output;
}

?>