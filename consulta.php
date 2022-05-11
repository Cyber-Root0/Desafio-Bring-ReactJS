<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tic Tac Toe | Bring - Consultar Jogadas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .disclaimer{
        display:none;
    }

/* CSS */
.button-88 {
  display: flex;
  align-items: center;
  font-family: inherit;
  font-weight: 500;
  font-size: 16px;
  padding: 0.7em 1.4em 0.7em 1.1em;
  color: white;
  background: #ad5389;
  background: linear-gradient(0deg, rgba(20,167,62,1) 0%, rgba(102,247,113,1) 100%);
  border: none;
  box-shadow: 0 0.7em 1.5em -0.5em #14a73e98;
  letter-spacing: 0.05em;
  border-radius: 20em;
  cursor: pointer;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-88:hover {
  box-shadow: 0 0.5em 1.5em -0.5em #14a73e98;
}

.button-88:active {
  box-shadow: 0 0.3em 1em -0.5em #14a73e98;
}
</style>
</head>
<body>
    <?php
    if (!empty($_GET['id'])){
         $id=addslashes($_GET['id']);
         $json=get_dados($id);
         
    }else{
        $json=get_dados(0);
        
    }
    
    function get_dados($id){
        if($id!=0){
        // OK    
        }else{
            $id="";
        }
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://www.tictactoe-bring.tk/api/get.php?id='.$id
        ]);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
        
    }
    ?>
<div class="">
    <form action="" method="GET">
        <input type="text" name="id">
        <input type="submit" value="Pesquisar Jogada">
        
    </form>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>#ID</th>
                <th>Ganhador</th>
                <th>Historico (X)</th>
                <th>Historico (O)</th>
            </tr>
        </thead>
        <tbody>
           <?php
          
           $object = json_decode($json);
           foreach ($object as $jogo) {
                
                $id=$jogo->id;
                $ganhador=$jogo->ganhador;
                $h_x=$jogo->historico_x;
                $h_o=$jogo->historico_o;
                
                echo "<tr>";
                echo "<th>".$id."</th>";
                echo "<th>".$ganhador."</th>";
                echo "<th>".$h_x."</th>";
                echo "<th>".$h_o."</th>";
                echo "</tr>";
                
            }
           
           
           
           ?>
        </tbody>
    </table>
</div>
</body>
</html>
